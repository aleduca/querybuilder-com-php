@extends('site.master')
@section('content')

<h2>Post - {{ $post->title }}</h2>

{{ $post->content }}

@stop