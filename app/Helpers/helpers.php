<?php


if (!function_exists('imageUploader')) {
    function imageUploader($file, $path, $old_image = null)
    {

        if ($old_image) {
            fileUnlink($old_image);
        }

        $file_image = $file;
        $slug = $path;
        $file_name = $slug . '-' . uniqid() . '.' . $file_image->getClientOriginalExtension();
        $upload_path = 'uploads/' . $path . '/' . date('Y-m-d') . '/';
        $file_image->move($upload_path, $file_name);

        $file_url = $upload_path . $file_name;
        return $file_url;
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
