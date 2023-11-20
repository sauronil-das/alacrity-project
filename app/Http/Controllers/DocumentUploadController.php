<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DocumentUploadController extends Controller
{
    public function show()
    {
        return Inertia::render('UploadDocuments');
    }
    public function upload(Request $request)
    {
        
        $request->validate([
            'brp' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5000',
            'passport' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5000',
        ]);

        $brpPath = $passportPath = '';

        if ($request->hasFile('brp')) {
            $brpFile = $request->file('brp');
            $brpPath = $brpFile->store('documents/brp', 'public');
        }

        if ($request->hasFile('passport')) {
            $passportFile = $request->file('passport');
            $passportPath = $passportFile->store('documents/passport', 'public');
        }

        return response()->json([
            'message' => 'Files uploaded successfully',
            'brpPath' => $brpPath,
            'passportPath' => $passportPath
        ]);
    }
}
