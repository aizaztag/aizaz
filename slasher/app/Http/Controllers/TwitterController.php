<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Twitter;
use Session;
use Redirect;
use App\User;
use App\Tweet;
use Auth;
use DB;

class TwitterController extends Controller
{
    public function __construct()
    {
        // protects every single method except twitterlogin, twittercallback
        $this->middleware('auth', ['except' => ['twitterlogin', 'twittercallback']]);

    }

    public function twitterlogin()
    {
        // your SIGN IN WITH TWITTER  button should point to this route
        $sign_in_twitter = TRUE;
        $force_login = FALSE;
        $callback_url = 'http://' . $_SERVER['HTTP_HOST'] . '/twitter/callback';
          //  dd($callback_url);
        $request_token = [
            'token' => Auth::user()->oauth_token,
            'secret' => Auth::user()->oauth_token_secret,
        ];

        // merge app keys and user tokens into one variable
       // Twitter::set_new_config($request_token);

        // Request user tokens from Twitter
        $token = Twitter::getRequestToken($callback_url);

        if (isset($token['oauth_token_secret'])) {

            // build the authorization url
            $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

            // set user tokens into session
            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

            // redirect to authorization url
            return Redirect::to($url);
        }

        return Redirect::to('twitter/error');
    }

    public function twittercallback()
    {
        if (Session::has('oauth_request_token')) {
            $request_token =  [
                'token' => Session::get('oauth_request_token'),
                'secret' => Session::get('oauth_request_token_secret'),
            ];

            // $request_token holds the TEMPORARY credentials, only used for initial login!
            // merge app keys and user tokens into one variable
           // Twitter::set_new_config($request_token);

            $oauth_verifier = FALSE;
            if (Input::has('oauth_verifier')) {
                $oauth_verifier = Input::get('oauth_verifier');
            }
          //dd($oauth_verifier);
            // getAccessToken() will reset the $request_token for you
           /* $token = Twitter::getAccessToken($oauth_verifier);
            if (!isset($token['oauth_token_secret'])) {
                return Redirect::to('sorry')->with('error', 'We could not log you in on Twitter.');
            }*/

            // at this point we have NEW tokens, these are the ones to save into the database
            // These tokens can be used to make api calls at a later time
            // $user->oauth_token = $token['oauth_token'];
            // $user->oauth_token_secret = $token['oauth_token_secret'];

            $credentials = Twitter::query('account/verify_credentials');
            if (is_object($credentials) && !isset($credentials->error)) {
                // $credentials contains the Twitter user object with all the info about the user.
                // Add here your own user logic, store profiles, create new users on your tables...you name it!
                // Typically you'll want to store at least, user id, name and access tokens
                // if you want to be able to call the API on behalf of your users
                // This is also the moment to log in your users if you're using Laravel's Auth class
                //  Auth::login($user); should do it
                //  dd($credentials);
                // create a new user with Eloquent and log them in
                dd($credentials);
                $user = new User;
                $user->twitter_id = $credentials->id;
                $user->name = $credentials->name;
                $user->screen_name = $credentials->screen_name;
                $user->location = $credentials->location;
                $user->description = $credentials->description;
               // $user->expanded_url = $credentials->entities->url->urls[0]->expanded_url;
                $user->followers_count = $credentials->followers_count;
                $user->friends_count = $credentials->friends_count;
                $user->listed_count = $credentials->listed_count;
                $user->twitter_created_at = $credentials->created_at;
                $user->favourites_count = $credentials->favourites_count;
                $user->statuses_count = $credentials->statuses_count;
                $user->status = $credentials->status->text;
                $user->profile_image_url = $credentials->profile_image_url;
               // $user->oauth_token = $token['oauth_token'];
               // $user->oauth_token_secret = $token['oauth_token_secret'];
                $user->save();
                Auth::login($user);

                Session::flash('flash_message', '<b>Howdy Partner!</b> You made it.');
                Session::flash('flash_type', 'alert-success');
                return Redirect::to('gettweets');
            }
            Session::flash('flash_message', '<b>Ouch!</b> Something went wrong, try again later.');
            Session::flash('flash_type', 'alert-danger');
            return Redirect::to('/');
        }
    }


    public function gettweets()
    {

        // grab the token and secret from our database
        // since we are authenticated, we can fetch this info with Auth::user()
        $request_token = [
            'token' => Auth::user()->oauth_token,
            'secret' => Auth::user()->oauth_token_secret,
        ];

        // merge app keys and user tokens into one variable
        Twitter::set_new_config($request_token);

        // you are now ready to make api calls on behalf of the user
        // fetch the twitter_id of the user from our database first

        $tweets = Twitter::getUserTimeline([
            'user_id' => Auth::user()->twitter_id,
            'include_entities' => 'true',
            'include_rts' => 'true',
            'exclude_replies' => 'false',
            'trim_user' => 'true',
            'count' => 100
        ]);


        // We’ll use Laravel’s Query Builder to insert the tweets

        foreach ($tweets as $tweet) {
            $tweet_id = $tweet->id;
            $tweet_text = $tweet->text;
            $twitter_created_at = date('Y-m-d H:i:s', strtotime($tweet->created_at));
            $retweet_count = $tweet->retweet_count;
            $twitter_id = $tweet->user->id;

            if (isset($tweet->retweeted_status)) {
                $is_rt = 1;
                $tweet_text = $tweet->retweeted_status->text;
                $retweet_count = 0;
                $retweet_user_id = $tweet->retweeted_status->user->id;
                $entities = $tweet->retweeted_status->entities;
            } else {
                $is_rt = 0;
                $entities = $tweet->entities;
            }

            DB::table('tweets')->insert(
                [
                    'tweet_id' => $tweet_id,
                    'tweet_text' => $tweet_text,
                    'twitter_created_at' => $twitter_created_at,
                    'twitter_id' => $twitter_id,
                    'is_rt' => $is_rt,
                    'retweet_count' => $retweet_count
                ]
            );

            if ($is_rt) {
                DB::table('tweet_retweets')->insert(
                    [
                        'tweet_id' => $tweet_id,
                        'twitter_created_at' => $twitter_created_at,
                        'source_user_id' => $twitter_id,
                        'target_user_id' => $retweet_user_id
                    ]
                );
            }

            if ($entities->hashtags) {
                foreach ($entities->hashtags as $hashtag) {
                    $tag = $hashtag->text;
                    DB::table('tweet_tags')->insert(
                        [
                            'tweet_id' => $tweet_id,
                            'twitter_id' => $twitter_id,
                            'twitter_created_at' => $twitter_created_at,
                            'tag' => $tag
                        ]
                    );
                }
            }

            if ($entities->user_mentions) {
                foreach ($entities->user_mentions as $user_mention) {
                    $target_user_id = $user_mention->id;
                    DB::table('tweet_mentions')->insert(
                        [
                            'tweet_id' => $tweet_id,
                            'twitter_created_at' => $twitter_created_at,
                            'source_user_id' => $twitter_id,
                            'target_user_id' => $target_user_id
                        ]
                    );
                }
            }

            if ($entities->urls) {
                foreach ($entities->urls as $url) {
                    $url = $url->expanded_url;
                    DB::table('tweet_urls')->insert(
                        [
                            'tweet_id' => $tweet_id,
                            'twitter_created_at' => $twitter_created_at,
                            'twitter_id' => $twitter_id,
                            'url' => $url
                        ]
                    );
                }
            }
        }

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function twitterUserTimeLine()
    {
        $data = Twitter::getUserTimeline(['count' => 10, 'format' => 'array']);
        return view('twitter',compact('data'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function tweet(Request $request)
    {
        $this->validate($request, [
            'tweet' => 'required'
        ]);


        $newTwitte = ['status' => $request->tweet];


        if(!empty($request->images)){
            foreach ($request->images as $key => $value) {
                $uploaded_media = Twitter::uploadMedia(['media' => File::get($value->getRealPath())]);
                if(!empty($uploaded_media)){
                    $newTwitte['media_ids'][$uploaded_media->media_id_string] = $uploaded_media->media_id_string;
                }
            }
        }


        $twitter = Twitter::postTweet($newTwitte);


        return back();
    }
}
