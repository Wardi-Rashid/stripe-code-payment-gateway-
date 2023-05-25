<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    //
    public function index()
     {
        return view(view: 'index') ;
     }

     public fucntion checkout() {
        \Stripe\Stripe::setApiKey(config(key: 'Stripe.sk')) ; 
        $session = \Stripe\Checkout\Session::create([
            'line_items'=>[
                [
                    'price_data'=> [
                        'currency' =>'gbp' ,
                        'product_data'=>[
                            'name'=>'Send me money!!!',

                        ],
                        'unit_amount'=>500 , //5 pound
                    ],
                    'quantity' =>1,
                ],
            ],
            'mode' =>'payment',
            'success_url' =>route(name: 'success'),
            'cancel_url' =>route(name: 'index') ,
        ])
        retun redirect()->away($session->url) ;

     }

     public function success() {
        return view('index') ; 
     }
}
