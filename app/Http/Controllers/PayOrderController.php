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
        $charge_amount = 2500;
        $order = $orderDetails->all();
        $result = $paymentGateway->charge($charge_amount);

        return view('pay.store', compact('result', 'charge_amount'));
    }
}
