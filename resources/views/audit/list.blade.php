@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h1>Audit List</h1>
        <div>
            <a href="/audit" class="btn btn-success ">Back</a>

        </div>
    </div>
    <div class="card-header">
        <table class="table" id="table">
            <thead id="table-head">
                <tr>
                    <th scope="col">Invoice #</th>
                    <th scope="col">Total Patients</th>
                    <th scope="col">Free Patients</th>
                    <th scope="col">Paid Patients</th>
                    <th scope="col">Total Income</th>
                </tr>

            </thead>
            <tbody id="table-body">
                <tr>
                    <td scope="row">{{ $starting_invoice . ' - ' . $ending_invoice }}</td>
                    <td>
                        {{$total_patients}}
                    </td>
                    <td>{{ $free_patients }}</td>
                    <td>{{ $paid_patients }}</td>
                    <td>{{ $total_amount}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-body p-0">
        <table class="table" id="table">
            <thead id="table-head">
                <tr>
                    <th scope="col">Invoice #</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Fee</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($patients as $patient)
                <tr>
                    <td scope="row">{{ $patient->id }}</td>
                    <td>
                        <button type="button" class="border-0 text-primary detailModal-btn" data-id="{{$patient->id}}" data-toggle="modal" data-target="#detailModal" data-link="/patients/{{$patient->id}}/show">
                            {{ $patient->name . '  ' . $patient->guardian_name }}
                        </button>
                    </td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->fee }}</td>
                    <td>{{ $patient->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- Modal --}}
<div class="modal fade" id="detailModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body " id="detailModal-body">
                <div class="row py-1">
                    <h1>No data found</h1>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
