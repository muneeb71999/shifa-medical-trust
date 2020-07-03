@extends('layouts.base')

@section('custome-content')

<div class="row justify-content-center mt-5 ">
    <div class="col-md-10">
        @include('patients.form', [
        'action' => '/patients/store',
        'method' => 'POST',
        ])
    </div>
</div>

@endsection
