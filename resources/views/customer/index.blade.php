@extends('layouts.app')

@section('content')
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Active</th>
        </tr>
    </thead>
    @foreach($customers as $customer)
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->active }}</td>
        </tr>
    @endforeach
</table>

{{--{{ $customers->appends(request()->input())->links() }}--}}

{{--@if(request()->has('max_count'))--}}
{{--    <div style="color: red;">NOTE: Pagination and max_count will not work together because pagination overwrites the limit() method!</div>--}}
{{--@endif--}}
@endsection
