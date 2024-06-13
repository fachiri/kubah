<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilePondController extends Controller
{
    public function load_file(Request $request)
    {
        $fileContent = file_get_contents($request->filepath);
        $mimeType = mime_content_type($request->filepath);

        return response($fileContent)
            ->header('Content-Type', $mimeType);
    }
}
