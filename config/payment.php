<?php
return [

    'default'=>'cod',

    'gateways'=>[

        'cod'=>[
            'class'=>App\Services\Payment\Gateways\CodPayment::class
        ],

        'razorpay'=>[
            'class'=>App\Services\Payment\Gateways\RazorpayPayment::class
        ],

        'stripe'=>[
            'class'=>App\Services\Payment\Gateways\StripePayment::class
        ],

        'paypal'=>[
            'class'=>App\Services\Payment\Gateways\PaypalPayment::class
        ],
    ]
];