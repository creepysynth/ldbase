<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGatewayContract;
use App\Orders\OrderDetails;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{
    public function store(OrderDetails $orderDetails, PaymentGatewayContract $paymentGateway)
    {
//        $paymentGateway = new BankPaymentGateway('usd');
        $order = $orderDetails->all();
        $result = $paymentGateway->charge(2500);

        return view('pay.store', compact('result'));
    }
}
