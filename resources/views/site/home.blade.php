@extends('site.master')
@section('content')

<ul>

  @foreach ($data['rows'] as $book)
    <li>{{ $book->title }}</li>
  @endforeach
</ul>

{!! $data['links'] !!}

@stop