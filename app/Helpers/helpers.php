<?php

use Illuminate\Http\Client\Request;
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

function volumetricWeight($l, $h, $b)
{
    return ($l * $b * $h) / 5000;
}


function packageTypes($type)
{
    $types = [
        'letter' => 'Letter / Envelope',
        'doc' => 'Document',
        'package' => 'Package / Non-Doc',
    ];

    if (isset($types[$type])) {
        return $types[$type];
    }
    
    return '';
}
