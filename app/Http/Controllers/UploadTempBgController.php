<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadTempBgController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'bg' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096', // 4MB max
        ]);

        $file = $request->file('bg');
        $filename = 'tmp_' . Str::random(16) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/tmp', $filename);
        $url = Storage::url($path);
        return response()->json(['url' => $url]);
    }
}
