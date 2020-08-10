@extends('layouts.app')

@section('content')
    <p>Amount: {{ $result['amount'] }}</p>
    <p>Confirmation number: {{ $result['confirmation_number'] }}</p>
    <p>Currency:  {{ $result['currency'] }}</p>
    <p>Discount:  {{ $result['discount'] }}</p>
    <p>Fees:  {{ $result['fees'] ?? 'n/a' }}</p>
@endsection
