<?php

use Illuminate\Support\Facades\Storage;

function adminAsset($url)
{
    return asset('admin-assets/' . $url);
}

function resellerAsset($url)
{
    return asset('reseller-assets/' . $url);
}

function deleteImage($path)
{
    if (Storage::exists($path)) {
        Storage::delete($path);
    }
}
