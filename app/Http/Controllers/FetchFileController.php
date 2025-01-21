<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\Log; // Add this import

class FetchFileController extends Controller
{
    public function index()
    {
        return view('files.fetch');
    }

    public function fetchFiles(Request $request)
    {
        $request->validate(['url' => 'required|url']);
        $url = rtrim($request->input('url'), '/') . '/';

        try {
            $response = Http::get($url);

            if ($response->successful()) {
                // Log the response body for debugging
                Log::info('Response Body:', ['body' => $response->body()]);

                preg_match_all('/<a href="([^"]+)">/', $response->body(), $matches);

                $files = array_filter($matches[1], function ($file) {
                    return !str_starts_with($file, '/'); // Exclude parent directory links
                });

                return response()->json(['files' => $files]);
            } else {
                Log::error('Failed Response', ['status' => $response->status()]);
            }
        } catch (\Exception $e) {
            Log::error('Error Fetching Files', ['message' => $e->getMessage()]);
        }

        return response()->json(['error' => 'Unable to fetch files.'], 400);
    }


    public function downloadFiles(Request $request)
    {
        $request->validate(['files' => 'required|array', 'url' => 'required|url']);

        $url = rtrim($request->input('url'), '/') . '/';
        $files = $request->input('files');
        $zip = new ZipArchive();

        $zipFileName = 'downloads.zip';
        $zipPath = storage_path('app/' . $zipFileName);

        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file) {
                $fileContents = Http::get($url . $file);
                if ($fileContents->successful()) {
                    $zip->addFromString($file, $fileContents->body());
                }
            }
            $zip->close();
        } else {
            return response()->json(['error' => 'Unable to create ZIP file.'], 500);
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
