<?php

namespace App\Http\Controllers;

use App\Jobs\SendWelcomeMail;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Handle Queue Process
     */
    public function processQueue()
    {

        $test2 =  app('test2');
        return TestFacades::testingFacades();


        //dispatch(new SendWelcomeMail('Sender Code Briefly'));
        echo 'Mail Sent';
    }
}
