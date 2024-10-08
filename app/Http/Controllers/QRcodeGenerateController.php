<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class QRcodeGenerateController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        return view('manager.qrcode');
    }

    public function generate(Request $request)
    {
        $result = 'sonos-2://devMode/set/?statement=' . $request->url;
        $qrCodes = [];
        $qrCodes['simple'] =
            QrCode::size(450)->generate($result);
        return view('manager.qrcode_result', $qrCodes);

    }

}
