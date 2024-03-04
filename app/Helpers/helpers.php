<?php


function imageUploader($file, $path, $old_image = null)
{

    if ($old_image) {
        if (file_exists($old_image)) {
            unlink($old_image);
        }
    }
    $file_image = $file;
    $slug = $path;
    $file_name = $slug . '-' . uniqid() . '.' . $file_image->getClientOriginalExtension();
    $upload_path = 'uploads/' . $path . '/' . date('Y-m-d') . '/';
    $file_image->move($upload_path, $file_name);

    $file_url = $upload_path . $file_name;
    return $file_url;
}
