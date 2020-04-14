<?php

//Route::view('/{path?}', 'app');


Route::group(['middleware' => ['web']], function () {
    Route::get('web-login', 'Auth\AuthController@webLogin');
    Route::post('web-login', ['as'=>'web-login','uses'=>'Auth\AuthController@webLoginPost']);
    Route::get('admin-login', 'AdminAuth\AuthController@adminLogin');
    Route::post('admin-login', ['as'=>'admin-login','uses'=>'AdminAuth\AuthController@adminLoginPost']);
});

/*$bind =  App::bind('Test' , function(){

   return new Test();

});*/

Route::get('/aizaz',   function () {
    Aizaz::testing();
});

Route::get('/flash', function() {
    return view('partials.flash');
});



Route::get('product-list', 'ProductController@index')->name('product.index');
Route::get('product-list/{id}/edit', 'ProductController@edit');
Route::post('product-list/store', 'ProductController@store');
Route::get('product-list/delete/{id}', 'ProductController@destroy');

Route::get('my-demo-mail','HomeController@myDemoMail');

Route::get('/ckeditor', 'CkeditorController@index');
Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');


Route::get('image2', 'Image2Controller@index');
Route::post('save-image2', 'Image2Controller@save');
//dd(app::make('aizaz'));

//dd(phpinfo());
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



/*
Route::get('/',   function () {
    return view('welcome');
});

Route::get('/test', ['middleware' => 'subscribed:aizaz.azzi@yahoo1.com' ,  function () {
    return 'return subscription page';
}]);
Route::get('service/post/gate', 'PostController@gate');

//Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');


Route::get('/twitter', function () {
    return view('twitter/login');
});



Route::get('gettweets', 'TwitterController@gettweets');

Route::get('twitterUserTimeLine', 'TwitterController@twitterUserTimeLine');
Route::post('tweet', ['as'=>'post.tweet','uses'=>'TwitterController@tweet']);
Route::get('/twitter/callback', 'TwitterController@twittercallback');


Route::get('login', 'Auth\AuthController@login')->name('login');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('auth/token/{token}', 'Auth\AuthController@authenticate');
Route::get('logout', 'Auth\AuthController@logout');

Route::get('dashboard', function () {
    return 'Welcome, ' . Auth::user()->name;
})->middleware('auth');*/

Route::get('auth/token/{token}', 'Auth\AuthController@authenticate');

Route::get('login', 'Auth\AuthController@login')->name('login');
Route::post('login', 'Auth\AuthController@postLogin')->name('login');
Route::get('register', 'Auth\AuthController@register')->name('register');


Route::get('/', 'HomeController@show');
Route::get('/userNotified', 'HomeController@userNotified');
Route::post('/', 'HomeController@storePhoneNumber');
Route::post('/custom', 'HomeController@sendCustomMessage');

Route::get('email', 'JobController@processQueue');


Route::get('email2', 'EmailController@sendEmail');

Route::get('dashboard', function () {
    return 'Welcome, ' . Auth::user()->name;
})->middleware('auth');

Route::get('contact', function () {
    return view('main');
});


Route::get('/facadeex', function() {
    return Person::getName();
});

Route::get('/facadetest', function() {
    return TestFacades::testingFacades();
});


Route::get('demo', function(){

    Demo::test();

});


Route::get('many', function(){

    $video = \App\Video::find('1');
    $tag = $video->tags;
    //dd($video);
    //$video->tags()->attach([2 ,3]);
    $video->tags()->detach('2');
});

Route::get('collection', function(){

  $all =   collect([1, 2, 3])->all();

  $average = collect([1, 1, 2, 4])->avg();
  $average = collect([['foo' => 10], ['foo' => 10], ['foo' => 20], ['foo' => 40]])->avg('foo');

  $collection = collect([1, 2, 3, 4, 5, 6, 7]);

  $chunks = $collection->chunk(4);

    $collection = collect([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);
    $collection = collect([['s' => 10], ['v' => 10], ['g' => 20], ['t' => 40]]);

    $collapsed = $collection->collapse();

    $collapsed->all();

    // [1, 2, 3, 4, 5, 6, 7, 8, 9]

    $collection = collect(['name', 'age']);

    $combined = $collection->combine(['George', 29]);

    $combined->all();

// ['name' => 'George', 'age' => 29]

    $collection = collect(['John Doe']);

    $concatenated = $collection->concat(['Jane Doe'])->concat(['name' => 'Johnny Doe']);

    $concatenated->all();

// ['John Doe', 'Jane Doe', 'Johnny Doe']

    $collection = collect(['name' => 'Desk', 'price' => 100 , 'price2' => 100]);

    //$collection->contains(100);

    //$collection = collect([1, 2, 2, 2, 3]);

    $counted = $collection->countBy();

    $counted->all();

    // [1 => 1, 2 => 3, 3 => 1]

    $collection = collect(['alice@gmail.com', 'bob@yahoo.com', 'carlos@gmail.com']);

    $counted = $collection->countBy(function ($email) {
        return substr(strrchr($email, "@"), 1);
    });

    dd($counted->all());
});


Route::get('image', 'ImageController@index');
Route::get('image/{id}', 'ImageController@edit')->name('image.edit');
Route::put('image/{id}', 'ImageController@update');
Route::post('save', 'ImageController@save');

Route::get('currency','CurrencyController@index');
Route::post('currency','CurrencyController@exchangeCurrency');

Route::get('qrcode-with-color', function () {
    $image = QrCode::format('png')->merge('https://www.w3adda.com/wp-content/uploads/2019/07/laravel.png', 0.3, true)
        ->size(200)->errorCorrection('H')
        ->generate('https://www.facebook.com/aizaz.tahirani');
    return response($image)->header('Content-type','image/png');

});




Route::resource('books','BookController');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::get('send', 'HomeController@sendNotification');

