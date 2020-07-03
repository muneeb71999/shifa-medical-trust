@extends('layouts.app')

@section('content')
<div class="container">
    @include('common.pageHeader')
    @yield('custome-content')
</div>
@endsection
