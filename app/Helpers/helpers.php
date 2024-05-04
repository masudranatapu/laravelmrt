<?php

use App\Models\Business;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

if (!function_exists("adminUser")) {
    function adminUser()
    {
        return Auth::guard("admin")->user();
    }
}

if (!function_exists("backendUser")) {
    function backendUser()
    {
        return Auth::user();
    }
}

if (!function_exists("myBusinesse")) {
    function myBusinesse()
    {
        $myBusiness = Business::findOrFail(backendUser()->business_id);
        return $myBusiness;
    }
}


if (!function_exists('imageUploader')) {
    function imageUploader($file, $path, $width = null, $height = null, $old_image = null)
    {
        if ($old_image) {
            fileUnlink($old_image);
        }

        $img = Image::make($file);

        $img->orientate();

        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $file_name = $path . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

        $businessId =  'admin';

        $upload_path = 'uploads/' . $businessId . '/' . $path . '/' . date('Y-m-d') . '/';

        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $img->save($upload_path . $file_name);

        return $upload_path . $file_name;
    }
}


if (!function_exists('getImagePath')) {
    function getImagePath($imagePath)
    {
        $path = '';
        if ($imagePath) {
            if (file_exists($imagePath)) {
                $path = asset($imagePath);
            } else {
                $path = asset('default/demo_user.png');
            }
        } else {
            $path = asset('default/demo_user.png');
        }
        return $path;
    }
}

if (!function_exists('fileUnlink')) {
    function fileUnlink($path)
    {
        if ($path && file_exists($path)) {
            unlink($path);
        }

        return true;
    }
}
