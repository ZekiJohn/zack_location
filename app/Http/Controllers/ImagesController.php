<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use File;
class ImagesController extends Controller
{
    public function index()
    {
        $save_path = public_path().'/image/';
        File::makeDirectory($save_path, $mode = 0755, true, true);
        Image::make('image/exapmple.jpg')->resize(300, 300)->save($save_path.'image.jpg');
        // $img = Image::make('image/exapmple.jpg');

        // // Apply another image as alpha mask on image
        // $img->mask('image/layer.png');

        // // Apply a second image with alpha channel masking
        // $img->mask('image/layer.png', true);
    }
}
