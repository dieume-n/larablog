<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class UploadFileController extends Controller
{
    public static function upload($file)
    {
        Cloudder::upload($file, null, ['folder' => 'blog/posts/']);
        $cloundary_upload = Cloudder::getResult();
        return [
            $cloundary_upload['secure_url'],
            $cloundary_upload['public_id'],
            str_replace('upload', 'upload/w_120,h_60,c_scale', $cloundary_upload['secure_url'])
        ];
    }
}
