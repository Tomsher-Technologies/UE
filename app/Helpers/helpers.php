<?php

use Illuminate\Support\Facades\Storage;

function adminAsset($url)
{
    return asset('admin-assets/' . $url);
}

function deleteImage($path)
{
    if (Storage::exists($path)) {
        Storage::delete($path);
    }
}
