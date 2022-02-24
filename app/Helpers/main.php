<?php

use App\Models\User;
use Illuminate\Support\Collection;

function aurl(string $url)
{
    return url('/admin'.$url);
}

function UploadImages(string $dir, $image, $checkFunction = null) : string
{
    $saveImage = '';

    if (! File::exists(public_path('uploads').'/'.$dir)) { // if file or fiolder not exists
        /**
         * @param $PATH Required
         * @param $mode Defualt 0775
         * @param create the directories recursively if doesn't exists
         */
        File::makeDirectory(public_path('uploads').'/'.$dir, 0775, true); // create the dir or the
    }

    if (File::isFile($image)) {

        $name = $image->getClientOriginalName(); // get image name
        $extension = $image->getClientOriginalExtension(); // get image extension
        $sha1 = sha1($name); // hash the image name

        $fileName = rand(1, 1000000).'_'.date('y-m-d-h-i-s').'_'.$sha1.'.'.$extension; // create new name for the image

        if (! is_null($checkFunction)) {
            if (! $checkFunction($name)) {
                return false;
            }
        }

        // get the image realpath
        $uploadedImage = Image::make($image->getRealPath());

        $uploadedImage->save(public_path('uploads/'.$dir.'/'.$fileName), '100'); // save the image

        $saveImage = $dir.'/'.$fileName; // get the name of the image and the dir that uploaded in
    }

    return $saveImage;
}

function ShowImage($image) : string
{
    if (! is_null($image) && ! empty($image) && File::exists(public_path('uploads').'/'.$image)) {
        return asset('uploads/'.$image);
    }

    return 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
}

function userCan(string $permission) : bool
{
    if (auth()->user()->hasRole(User::SuperAdminRole)) {
        return true;
    }

    static $permissions = [];

    $id = auth()->id();

    if (isset($permissions[$id])) {
        return in_array($permission, $permissions[$id]);
    }

    // save the persdissions to can Chack on the persissions
    $permissions[$id] = auth()->user()->getAllPermissions()->pluck('name')->toArray();

    return in_array($permission, $permissions[$id]);
}

function getData(Collection $data, $attr)
{
    return $data->has($attr) ? $data[$attr] : null;
}

 function checkValue($val)
 {
     return ! empty($val) && ! is_null($val);
 }

 function panic($msg)
 {
     throw new \Exception($msg);
 }
