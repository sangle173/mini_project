<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
class DownloadFileController extends Controller
{
    public function index()
    {
        return view('files.index');
    }

    public function fetchFiles(Request $request)
    {
        $url = $request->input('url');
        $extensions = $request->input('extensions', []); // Get selected extensions, default to an empty array

        $fileList = [];

        // Use cURL to fetch file list
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $htmlContent = curl_exec($ch);
        curl_close($ch);

        if ($htmlContent) {
            preg_match_all('/<a href="([^"]+)">/', $htmlContent, $matches);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $file) {
                    $fileName = basename($file);

                    // Exclude URLs containing "?C=" or similar sorting parameters
                    if (str_contains($file, '?C=')) {
                        continue;
                    }

                    // Check if the file matches any of the selected extensions
                    if (empty($extensions) || collect($extensions)->contains(function ($extension) use ($fileName) {
                            return str_ends_with($fileName, $extension);
                        })) {
                        $fileList[] = [
                            'name' => $fileName,
                            'url' => rtrim($url, '/') . '/' . $file,
                        ];
                    }
                }
            }
        }

        return response()->json($fileList);
    }


    public function downloadZip(Request $request)
    {
        $files = $request->input('files');

        if (empty($files)) {
            return back()->with('error', 'No files selected.');
        }

        $zip = new ZipArchive();
        $zipFileName = 'files.zip';
        $zipPath = storage_path($zipFileName);

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($files as $file) {
                $fileContents = file_get_contents($file);
                $zip->addFromString(basename($file), $fileContents);
            }
            $zip->close();
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}

