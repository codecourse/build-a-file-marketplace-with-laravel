<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileShowController extends Controller
{
    public function __invoke(Request $request, File $file)
    {
        abort_unless($request->hasValidSignature(), 401);

        return Storage::download($file->path, $file->filename);
    }
}
