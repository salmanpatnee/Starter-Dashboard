<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadImageTrait
{
    protected $path = "images/";

    protected function uploadTheImage(Request $request, $field = "image")
    {
        if ($request->$field) {

            $name = time() . '.' . explode('/', explode(':', substr($request->$field, 0, strpos($request->$field, ';')))[1])[1];

            \Image::make($request->$field)->save(public_path($this->path) . $name);

            return $name;
        }

        return null;
    }

    protected function isNewUpload(String $oldFile, String $newFile): bool
    {

        return $oldFile != asset($this->path . $newFile);
    }
}
