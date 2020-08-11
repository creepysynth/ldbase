@extends('layouts.app')

@section('content')
    <div><span class="font-weight-bold">Charge Amount:</span> {{ $charge_amount }}</div>
    <div><span class="font-weight-bold">Amount:</span> {{ $result['amount'] }}</div>
    <div><span class="font-weight-bold">Confirmation number:</span> {{ $result['confirmation_number'] }}</div>
    <div><span class="font-weight-bold">Currency:</span>  {{ $result['currency'] }}</div>
    <div><span class="font-weight-bold">Discount:</span>  {{ $result['discount'] }}</div>
    <div><span class="font-weight-bold">Fees:</span>  {{ $result['fees'] ?? 'n/a' }}</div>
@endsection
