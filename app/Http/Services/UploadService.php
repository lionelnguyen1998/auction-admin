<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Validator;

class UploadService implements UploadServiceInterface
{
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                // $result = $request->file('file')->storeOnCloudinary();
                // $url = $result->getPath();
                // return $url;
                $name = $request->file('file')->getClientOriginalName();
                $pathFull = 'uploads/' . date("Y/m/d");
                $request->file('file')->storeAs(
                    'public/' . $pathFull, $name
                );

                $url = 'http://admin.localhost:443/';
                
                return $url . '/storage/' . $pathFull . '/' . $name;
            } catch (\Exception $error) {
                return false;
            }
        }
    }
}