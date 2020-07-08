@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="card-header">Audit List</h1>
    <div class="row mt-5">
        <form action="{{route('audit.showPatients')}}" method="POST">
            @csrf
            <div class="row">
                <h3>Patients List</h3>
            </div>
            <div class="row">
                <div class="col">
                    <label for="starting_invoice">Starting Invoice</label>
                    <input class="form-control" name="starting_invoice" type="number" id="starting_invoice" required
                        autofocus>
                </div>
                <div class="col">
                    <label for="ending_invoice">Starting Invoice</label>
                    <input class="form-control" name="ending_invoice" type="number" id="starting_invoice" required>
                </div>
                <div class="col">
                    <label for="patient_list">Generate Report</label>

                    <button type="submit" class="btn btn-success " id="patients_list">
                        Generate Patients List
                    </button>
                </div>
            </div>

        </form>
    </div>
    <div class="row mt-5">
        <form action="{{route('audit.showMedicine')}}" method="POST">
            @csrf
            <div class="row">
                <h3>Medicine Sales List</h3>
            </div>
            <div class="row">
                <div class="col">
                    <label for="starting_invoice">Starting Invoice</label>
                    <input class="form-control" name="starting_invoice" type="number" id="starting_invoice" required
                        autofocus>
                </div>
                <div class="col">
                    <label for="ending_invoice">Starting Invoice</label>
                    <input class="form-control" name="ending_invoice" type="number" id="starting_invoice" required>
                </div>
                <div class="col">
                    <label for="patient_list">Generate Report</label>

                    <button type="submit" class="btn btn-success " id="patients_list">
                        Generate Medicine List
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection
