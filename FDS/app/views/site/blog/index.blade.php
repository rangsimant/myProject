@extends('site.layouts.default')

{{-- Content --}}
@section('content')
<h1>Hello</h1>

{{ $posts->links() }}

@stop
