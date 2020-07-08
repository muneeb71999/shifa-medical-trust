@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header h2">Dashboard</div>

    @admin
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total Patient this month
                    </div>
                    <div class="card-body">
                        <h1>{{$totalPatients}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total Salary this month
                    </div>
                    <div class="card-body">
                        <h1>{{$employeesSalary}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total Patient This month
                    </div>
                    <div class="card-body">
                        <h1>{{$medicineSale}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endadmin
    <!-- <div class="row justify-content-center"> -->
    <!-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div> -->
    <!-- </div> -->
</div>
@endsection
