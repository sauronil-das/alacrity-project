<?php

namespace App\Http\Controllers;
use App\Mail\DocumentUploadMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
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

        

        if ($request->hasFile('brp')) {
            $brpPath = $request->file('brp')->store('documents/brp', 'public');

            // Do you need a full HTTP URL to the uploaded file?
            $url = Storage::url($brpPath);

            // Do we want to update the user model?
            // Something like??
            // Auth::user()->documents()->create([
            //     'url' => $url,
            //     'type' => 'brp'
            // ]);
        }

        if ($request->hasFile('passport')) {
            $passportPath = $request->file('passport')->store('documents/passport', 'public');
            $userEmail = Cache::get('userEmail');
            Mail::to($userEmail)->send(new DocumentUploadMail());
        }

        

        return response()->json([
            'message' => 'Files uploaded successfully',
            'brpPath' => $brpPath,
            'passportPath' => $passportPath
        ]);
    }
}
