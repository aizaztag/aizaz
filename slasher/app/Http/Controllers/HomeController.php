<?php

namespace App\Http\Controllers;

use App\Affiliation;
use App\Mail\MyDemoMail;
use App\Notifications\MyFirstNotification;
use App\Post;
use App\Tag;
use App\User;
use App\UsersPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Twilio\Rest\Client;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $post  = Affiliation::find(1);
        //  $post->tags()->attach(2);
        //dd( $post->tags->pluck('name')[0]);

        $a  = Affiliation::find(1);
       // dd($a);

        $posts =  Post::with('tags')->whereIn('id', [1])->get();
        $tags =   Tag::with('posts')->whereIn('id', [1])->get();
        $affs =   Affiliation::with('posts')->whereIn('id', [1])->get();
       //dd($aff->posts);


        foreach ($affs as $aff)
        {
            //$product->skus is a collection of Sku models
           dd( $aff->posts[0]->title );
        }
        foreach ($posts as $post)
        {
            //$product->skus is a collection of Sku models
          // dd( $post->tags[0]->name );
        }
        return view('home');
    }


    /**
     * Show the forms with users phone number details.
     *
     * @return Response
     */
    public function show()
    {

        $users = UsersPhoneNumber::all();
        return view('welcome', compact("users"));
    }
    /**
     * Store a new user phone number.
     *
     * @param  Request  $request
     * @return Response
     */
    public function storePhoneNumber(Request $request)
    {
        //run validation on data sent in
        $validatedData = $request->validate([
            'phone_number' => 'required|unique:users_phone_number|numeric',
        ]);
        $user_phone_number_model = new UsersPhoneNumber($request->all());
        $user_phone_number_model->save();
        $this->sendMessage('User registration successful!!', $request->phone_number);
        return back()->with(['success' => "{$request->phone_number} registered"]);
    }
    /**
     * Send message to a selected users
     */
    public function sendCustomMessage(Request $request)
    {
        $validatedData = $request->validate([
            'users' => 'required|array',
            'body' => 'required',
        ]);
        $recipients = $validatedData["users"];
        // iterate over the array of recipients and send a twilio request for each
        foreach ($recipients as $recipient) {
            $this->sendMessage($validatedData["body"], $recipient);
        }
        return back()->with(['success' => "Messages on their way!"]);
    }
    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients Number of recipient
     */
    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
    }

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function myDemoMail()

    {

        $myEmail = 'aizaz.azzi@yahoo.com';

        $details = [

            'title' => 'Mail Demo from ItSolutionStuff.com',

            'url' => 'https://www.itsolutionstuff.com'

        ];



        Mail::to($myEmail)->send(new MyDemoMail($details));



        dd("Mail Send Successfully");

    }

    public function sendNotification()

    {

        $user = User::find('1');



        $details = [

            'greeting' => 'Hi Artisan',

            'body' => 'This is my first notification from ItSolutionStuff.com',

            'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',

            'actionText' => 'View My Site',

            'actionURL' => url('/'),

            'order_id' => $user->id

        ];



        Notification::send($user, new MyFirstNotification($details));



        dd('done');

    }

    public function userNotified()
    {
        $user   = \App\User::find('1');
       // dd($user);
        foreach ($user->notifications as $notification) {
            echo $notification->type;
        }

        return view('user_notified' ,
            [
            'notified' =>   tap($user->unreadNotifications)->markAsRead()
            ]
        );

    }
}
