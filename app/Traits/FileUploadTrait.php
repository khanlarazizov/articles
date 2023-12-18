<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{
    public function storeFile(Request $request, $fieldName = 'file', $directory = null)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/documents/' . $directory, $fileName);
            return $fileName;
        }
        return null;
    }

    public function updateFile(Request $request, $fieldName = 'file', $modelName, $directory = null)
    {
        $fileName = '';
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/documents/' . $directory, $fileName);
            if ($modelName->file) {
                Storage::delete('public/documents/' . $directory . '/' . $modelName->file);
            }
            return $fileName;
        } else {
            $fileName = $modelName->file;
            return $fileName;
        }
    }
}
