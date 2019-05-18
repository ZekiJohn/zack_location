<?php

use Illuminate\Http\Request;
use App\Dog;
use App\Transformers\UserTransformer;
use App\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Api'], function(){
    Route::resource('dog', 'DogsController');
});
/**
 * Writing my own transformer
 */
Route::get('/users/{id}', function($userId, Request $request){
    $embeds = explode(',', $request->input('embed'));
    return (new UserTransformer(User::findOrFail($userId, $embeds)));
});


Route::get('/dogs', function(Request $request) {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    // return Dog::orderBy('age', 'DESC') ->orderBy('weight', 'ASC')->paginate(10);

# =====================================================================================
    #    ?filter=sex:female
    $query = Dog::query();
    if($request->has('filter')){
        list($criteria, $value) = explode(':', $request->input('filter'));
        $query->where($criteria, $value);
    }
    return $query->paginate(10);
# =====================================================================================
    #  to handle    "?sort=name,-weight"
    $sorts = $request->input('sort', 'name');
    $sorts = explode(',', $sorts);
    $query = Dog::query();
    foreach($sorts as $sortCol){
        $direction = starts_with($sortCol, '-') ? 'desc' : 'asc';
        $sortCol = ltrim($sortCol, '-');
        $query->orderBy($sortCol, $direction);
    }
    return [$query];
    return $query->paginate(10);
# ======================================================================================
    // return $request->input(); // get the get parameters
# ======================================================================================
    # sort response according the parameter options / asc or desc and Of course sort column
    // $sortCol = $request->input('sort', 'name');
    // if(starts_with($sortCol, '-')){
    //     $sortOpt = 'desc';
    //     $sortCol = ltrim($sortCol, '-');
    // }else{
    //     $sortOpt = 'asc';
    // }
    // return Dog::orderBy($sortCol, $sortOpt)->paginate(10);

});
