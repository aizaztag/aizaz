<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use AshAllenDesign\LaravelExchangeRates\ExchangeRate;

use Guzzle\Http\Exception\ClientErrorResponseException;

use carbon\Carbon;

class CurrencyController extends Controller
{
    //

    public function index() {

        return view('currency');
    }

    public function exchangeCurrency(Request $request) {

        $amount = ($request->amount)?($request->amount):(1);

        $apikey = 'd1ad6bab1eece610c64c';

        $from_Currency = urlencode($request->from_currency);
        $to_Currency = urlencode($request->to_currency);
        $query =  "{$from_Currency}_{$to_Currency}";
        // dd("http://free.currconv.com/api/v5/convert?q={$query}&amp;compact=y&amp;apiKey={$apikey}");
        // change to the free URL if you're using the free version
        //$json = file_get_contents("https://free.currencyconverterapi.com/api/v5/convert?q={$query}&amp;compact=y&amp;apiKey={$apikey}");
        $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
        $obj = json_decode($json, true);
          //  echo '<pre>' ; print_r("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}"); die;

        $val = $obj["$query"];

         //echo '<pre>' ; print_r($val['val']); die;


        $total = $val * 1;

        $formatValue = number_format($total, 2, '.', '');

        $data = "$amount $from_Currency = $to_Currency $formatValue";

        echo $data; die;



    }

}
