<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function download($filename)
    {
        $path = storage_path('app/public/' . $filename);
        
        if (file_exists($path)) {
            return response()->download($path);
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    }
}
