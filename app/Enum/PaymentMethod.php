<?php
namespace App\Enum;

enum PaymentMethod:string
{
    case COD='cod';

    case RAZORPAY='razorpay';

    case STRIPE='stripe';

    case PAYPAL='paypal';
}