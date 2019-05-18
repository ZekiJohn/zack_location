<?php
use App\Contact;
use App\User;
use App\PhoneNumber;
use App\Json;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Request;
use function GuzzleHttp\json_decode;
use App\Vehicle;
use Symfony\Component\HttpFoundation\Cookie;

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
 * chapter 14 Storage and retrival
 */
Route::get('/readcookie', function(Request $request){
    return $request->cookie('visited-location', 'nope-no-cookie-like'); // return 1 if cookie found or the fallback
});
Route::get('/cookie', function(){
    return
    $cookie = cookie('visited-location', true);
    return Response::view('cookie')->cookie($cookie);
});
Route::get('/cache', function(){
    cache()->put('user_name', 'Zack', 3600);
    return cache()->get('user_name');
});
Route::get('/sessionredirect', function(){
    return session()->get('Zack', 'Oops! we dont get any session here.');
});
Route::get('/session', function(Request $request){
// ====================================================================
    session()->flash('Zack', "I'm comming from another page.");
    return redirect('/sessionredirect');
// ====================================================================
    session()->regenerate(); // to regenerate session id
// ====================================================================
    session()->pull($key, $fallback); // the same as get but it will delete it after return it
// ====================================================================
    session()->forget($key); // destroy specific session
    session()->flush(); // destroyes all the sessions
// ====================================================================
    session()->all(); // common it's clear what these funciton going to do
// ====================================================================
    sesson()->has($key); //you guessed it and of course you are write
// ====================================================================
    session()->push($key, $value); // use this if your value is array
// ====================================================================
    session()->put('zack', 'Zack John Ye mule Lig');
// ====================================================================
    return session()->get('zack', 'define your fallback');
// ====================================================================
    return $request->session()->get('user_id', 'no value provided');
    // return Session::get('user_id', 'no value provided'); // using Facade
// ====================================================================
    session()->put('zack', 'Zack John Ye mule Lig');
    // session(['zack', 'Zack John Ye mule Lig']); // this would also give the same result as the above
    return (session()->get('zack'));
// ====================================================================
    echo '<pre>';
        print_r(session()->get('_previous'));
        // print_r(session('_previous')); // both are the same
    echo '</pre>';
});
/**
 * password strength meter
 */
Route::get('/pass', function(){
    return view('pass');
});
Route::get('/user', function(){
    $http = new GuzzleHttp\Client;
    $response = $http->request('GET', 'http://speakr.dev/api/user', [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken,
        ],
    ]);
})->middleware('auth:api');
/**
 * APIs
 * i will use api.php to test api related things here it's just a demostraition
 */
Route::get('/WebApi', function(){
    return User::all();
    $users = User::get();
    // return response()->json($users, 200);
    echo $users; // the echo will authomaticaly convert iteself to JSON (useing __toString() magic method)
});
/**
 * Container Chapter 11
 */
Route::get('/container', function(){
    App::singleton('App\Billing\Stripe', function(){
        return new App\Billing\Stripe(env('APP_KEY'));
    });
    // App::bind('App\Billing\Stripe', function(){
    //     return new App\Billing\Stripe(env('APP_KEY'));
    // });

    $stripe = app('App\Billing\Stripe');
    // $stripe = resolve('App\Billing\Stripe');
    // $stripe = App::make('App\Billing\Stripe');

    dd($stripe);
    // Log::alert('something gone wrong. please fix the it ..........');
});
/**
 * Response
 */
Route::get('/response', function(){
    //finaly create your own custom response
    return response()->myJson(['myName' => 'Zack']);

    //Redirects
    return redirect()->with('success/error', 'Success/Error Message');
    return back()->withInput();
    return redirect()->action('ControllerName@methodName', ['data' => 'value']);  //second parameter is optional
    return redirect()->route('home', ['data' => 'value']); //second parameter is optional
    return redirect()->to('/');
    return response()->redirectTo('/request');  //we can but less common
    // ===================================================
    //JSON Response
    $data = User::get();
    $headers = [
        'header' => 'value',
    ];
    return response()->json($data, 200, $headers);
    //file Response
    return response()->file('file.pdf'); // the d/ce with download() is that it force the browser to display it instead of donload
    //Download Responses
    return response()->download('favicon.ico', 'download.png', ['header' => 'value']);
    //view Responses
    $data = [
        'this' => 'this is some data',
    ];
    return response()->view('data', $data);
    // ===================================================
    return response('Hello!')
    ->header('header-name', 'header-value')
    ->cookie('cookie-name', 'cookie-value');
    return new Illuminate\Http\Response('Hello!');
});
/**
 * Request
 */
Route::post('/request', function(Request $request){
    return response()->json($request->cookie());
    return response()->json($request->old());
    // --------------------------------------------------
    return response()->json($request->secure());
    return response()->json($request->server());
    return response()->json($request->ip());
    return response()->json($request->header());
    return response()->json($request->is('*req*'));
    return response()->json($request->url());  //with the domain
    return response()->json($request->path());  //without the domain
    return response()->json($request->method());
    return response()->json($request->except(['_token']));
    return response()->json($request->only(['name', 'email']));
    return response()->json($request->all());
});
Route::get('/request', function (){
    return view('request_and_response');
});
/**
 * Authorization
 */
Route::get('/autho', function(){
    $contact = Contact::find(1);
    if(Gate::allows('update-contact', $contact)){
        echo "Allowed";
    }else{
        echo "Denied";
    }
    //for user
    $user = User::find(21);
    if(Gate::forUser($user)->allows('update-contact')){
        echo "User Allowed";
    }else{
        echo "user Not Allowed";
    }
});
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
/**
 * Chapter 8 Database and Eloquent
 */
Route::get('/db_elo', function(){
    //check out internet for more info it's not working now
    $contacts = Contact::with(['user' => function($query){
        $query->where('age', '<',  83);
    }]);
    foreach($contacts as $contact){
        echo $contact;
    }
    // return User::with('contact')->get(); // this ain't gonna work because we do not have contact_id on users table
    return Contact::with('user')->get(); // this will get all contacts with users runn to ......
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


/**
 * storing json to database TEST
 */
Route::get('/json_store', function(){
    // $json = Json::find(1);
    // $result = json_decode($json->json);
    // return $result[0];
    $user = ['new', 'new', 'new', 111111111];
    $arr = [123269461, 6461321, 15642121, 9861321];
    Json::create([
        'user' => 'Zack',
        'json' => json_encode($arr),
    ]);
});
