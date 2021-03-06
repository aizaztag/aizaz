<?php

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


//  use DebugBar\DebugBar;


use App\Notifications\NotifyUser;
use App\User;

$f =  App::make('App\SocialMedia\Facebook');
/*Route::get('/{any}', function () {

    return view('vueCrud.post');
})->where('any', '.*');*/

//dd($f);
//Route::get('login/{provider}', 'SocialController@redirect');
//Route::get('login/{provider}/callback','SocialController@Callback');

//Route::get('/', 'DeshboardController@index');
//Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::resource('posts' , 'PostController');

Auth::routes();

Route::get('/deshboard', 'DeshboardController@index');
//Route::get('/layout', 'DeshboardController@index');

Route::get('/layout', function (){


    return view('master.child');
});

Route::get('/checkout2', function (){
    return view('paywithpaypal');
});
Route::get('/status_1', function (){
dd('here');
});
Route::post('paypal', 'PaymentController@payWithpaypal');
// route for check status of the payment
Route::get('status', 'PaymentController@getPaymentStatus');

/*Route::get('/{any}', function(){
    return view('landing');
})->where('any', '.*');*/


$stripe = App::make('App\Billing\Stripe');
//dd($stripe);

/*Route::get('post', function (){
    //Debugbar::info('vdgd');

    if(Gate::allows('pst', Auth::user())){
        dd('here');
    }

    return App\Post::all();
});*/



Route::get('/home', 'DeshboardController@index')->name('home');

Route::resource('valid', 'ValidationController');

Route::get('tickets/{id}', 'TicketsController@show');
Route::get('new_ticket', 'TicketsController@create');
Route::post('new_ticket', 'TicketsController@store');



Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('permissions', 'PermissionController');
   // Route::resource('products','ProductController');
});

Route::post('/products', 'ProductController@store')->name('products.store');

Route::get('/pdf', function (){
    /*$snappy = App::make('snappy.pdf');
//To file
    $html = '<h1>Bill</h1><p>You owe me money, dude.</p>';
    $snappy->generateFromHtml($html, 'bill-123.pdf');
    $snappy->generate('http://www.github.com', '/tmp/github.pdf');
//Or output:
    return new Response(
        $snappy->getOutputFromHtml( $html),
        200,
        array(
            'Content-Type'          => 'application/pdf',
            'Content-Disposition'   => 'attachment; filename="file.pdf"'
        )*/
/*);*/

    $data = '<h1>Bill</h1><p>You owe me money, dude.</p>';

    $pdf = PDF::loadHtml($data);
return $pdf->stream();

});

/*
Route::get('/facadeex', function() {
    return TestFacades::testingFacades();
});

class Facade{
    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
        return app()->make(static::getFacadeAccessor())->$name();
    }

    protected static function getFacadeAccessor(){

    }
}

class Bike {

    public function start(){
        return 'startd';
    }

}

class BikeFacade extends Facade{

     protected static function getFacadeAccessor(){
        return 'bike' ;
     }
}*/



app()->bind('bike' , function (){
   return new Bike;
});
//dd(BikeFacade::start());

Route::get('/noti', function() {
    User::find(2)->notify(new NotifyUser());
    return 'done';
});

Route::get('/alpha', function () {
    return view('alpha');
});


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('form', 'FormController@create')->name('form.create');
Route::post('form', 'FormController@store')->name('form.store');
   
