<?php
namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class WriteMessageToFile
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserLoggedIn $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        $message = $event->request->user()->name . ' just logged in to the application.';
        $exists = Storage::disk('local')->exists('loginactivity.txt');

        $contents = (($exists) ? Storage::get('loginactivity.txt') : '');
        $contents = $contents ."\r\n";

        Storage::put('loginactivity.txt', $contents .  $message);
    }
}