<?php
// use Symfony\Component\Routing\Route;
// use Image;
// use File;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/image', function () {
    // $save_path = public_path().'/image/';
    // File::makeDirectory($save_path, $mode = 0755, true, true);
    // Image::make('image/exapmple.jpg')->resize(300, 300)->save($save_path.'image.jpg');
    // $img = Image::make('image/exapmple.jpg');

    // // Apply another image as alpha mask on image
    // $img->mask('image/layer.png');

    // // Apply a second image with alpha channel masking
    // $img->mask('image/layer.png', true);
});
Route::get('/img', 'ImagesController@index');
