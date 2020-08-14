@extends('layouts.app')

@section('content')
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Active</th>
        </tr>
    </thead>
    @foreach($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->active }}</td>
        </tr>
    @endforeach
</table>

{{ $posts->appends(request()->input())->links() }}

@if(request()->has('max_count'))
    <div style="color: red;">NOTE: Pagination and max_count will not work together because pagination overwrites the limit() method!</div>
@endif
@endsection
