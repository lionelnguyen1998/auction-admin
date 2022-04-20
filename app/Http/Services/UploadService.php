<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Validator;

class UploadService implements UploadServiceInterface
{
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                $result = $request->file('file')->storeOnCloudinary();
                $url = $result->getPath();
                return $url;
            } catch (\Exception $error) {
                return false;
            }
        }
    }
}