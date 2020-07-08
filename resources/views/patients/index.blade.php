@extends('layouts.base')

@section('custome-content')

@admin
<div class="card mt-5">
    <div class="card-header">
        Daily Patient
    </div>
    <div class="card-body">
        <canvas id="myChart" class="h-25" style="height: 400px; widht:container-width;"></canvas>
    </div>
</div>
@endadmin
<div class="card mt-4">
    <div class="card-header  d-flex justify-content-between align-items-center">
        <div class="h5 mt-1">Patient Record</div>
        <div class="w-50 d-flex justify-content-between align-items-center">
            <input type="search" id="search" class="form-control w-100 mr-2" placeholder="Search here....." autofocus>
            <div class="d-flex align-items-center">
                <div class="spinner-border ml-auto d-none " id="loading" role="status" aria-hidden="true"></div>
            </div>
        </div>
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
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($patients as $patient)
                <tr>
                    <td scope="row">{{ $patient->id }}</td>
                    <td>
                        <button type="button" class="border-0 text-primary detailModal-btn" data-id="{{$patient->id}}"
                            data-toggle="modal" data-target="#detailModal" data-link="/patients/{{$patient->id}}/show">
                            {{ $patient->name . '  ' . $patient->guardian_name }}
                        </button>
                    </td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->fee }}</td>
                    <td>{{ $patient->created_at}}</td>
                    <td>
                        @admin
                        <form method="POST" action="{{route('patients.destroy', $patient->id)}}" class="form">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                                Delete
                            </button>
                        </form>
                        @endadmin
                        <a class="btn btn-success btn-sm" href="/patients/{{$patient->id}}/print">Print</a>
                        <a class="btn btn-primary btn-sm" href="/patients/{{$patient->id}}/printAndSave">Save and
                            Print</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer text-right">
        <div id="pagination-container">
            {{ $patients->links() }}
        </div>
    </div>
</div>
{{-- Modal --}}
<div class="modal fade" id="detailModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="detailModalLabel" aria-hidden="true">
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
