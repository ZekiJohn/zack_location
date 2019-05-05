<?php
use App\Contact;
use App\User;
use App\PhoneNumber;

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
/**
 * relationship many to many
 */
Route::get('/mtom', function(){
    $user = User::first();
    //many to many relationship is not definded it's just a test!!
    $user->contacts->each(function($contact){
        //do something
    });
});
/**
 * Relationship one to many
 */
Route::get('/filter', function(){
    $users = User::get();
    $activated = $users->filter(function ($user){
        return $user->activated == 0;
    });
    return response()->json($activated, 200);
});
/**
 * RelationShips:- Inserting related items
 */
Route::get('/Rinsert', function(){
    $contact = Contact::first();

    $phone_number = new PhoneNumber;
    $phone_number->phone_number = '+251-9-65 02 93 62';

    $contact->phoneNumber()->save($phone_number);
    return response()->json($phone_number, 200);
});
/**
 * JSON response
 */
Route::get('/json', function () {
    $users = User::get();
    // return $users->toJson();
    return response()->json($users, 200);
});

/**
 * let's see how the collection object is powerful
 */
Route::get('/contacts', function(){
    $contacts = Contact::get();
    return response()->json($contacts);
});
Route::get('/users', function(){
    $users = User::get();
    return response()->json($users);
});
Route::get('/collect', function(){

    $array = [];
    for($i = 0; $i < 16; $i++){
        $array[] = $i;
    }
    $collection = collect($array);
    // $collection = $collection->map(function($item){
    //     return $item * $item;
    // });
    // $collection = $collection->reject(function($item){
    //     return $item % 2 === 0;
    // });
    $collection = $collection->filter(function($item){
        return $item % 2 !== 0;
    })->map(function($item){
        return $item * 10;
    })->sum();

    return response()->json($collection);

});
Route::get('/chunk', function(){
    Contact::chunk(100, function($contacts){

        foreach($contacts as $contact){
            echo $contact->name . "<br>";
            echo $contact->email;
        }
        echo "<br><br><br>";
        // return response()->json($contacts);
    });
});

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
