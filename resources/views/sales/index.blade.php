@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="p-0 py-2 card-header d-flex justify-content-between align-items-center">
        <span class="h2">{{ $page_title }}</span>
        <div>
            <a href={{ route('medicine.list') }} class="btn btn-success text-white">Medicine List</a>
            <a href={{ $page_url }} class="btn btn-success text-white">{{ $btn_title }}</a>
            <a href={{ route('sales.list') }} class="btn btn-success text-white">
                Sales List
            </a>
        </div>
    </h1>
    <div class="mt-4 ">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header " style="position: relative">
                        <input type="text" class="form-control" placeholder="Search Medicine Name.. " autofocus
                            id="search-medicine">

                    </div>
                    <div class="card-body p-0">
                        <table class="table">
                            <thead class="table-head">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>T.Qty</th>
                                    <th>U.P</th>
                                    <th>T.Price</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody class="table-body" id="medicine-sales-list">
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="h-5 d-flex justify-content-between align-items-center">
                            <div>Total Price</div>
                            <div id="totalAmount">0</div>
                        </div>
                        <div class="row mt-4 ">
                            <div class="text-center d-block w-100">
                                <button type="submit" class="btn-success btn btn-small"
                                    id="submit-medicine">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Medicine List</div>
                    <div class="card-body p-0">
                        <table class="table">
                            <thead class="table-head">

                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                </tr>
                            </thead>
                            <tbody class="table-body" id="medicine-list">
                                {{-- <div >

                                </div> --}}
                                {{-- <!-- @foreach ($medicines as $medicine)
                                <tr class="updateModal-btn" data-id="{{$medicine->id}}" data-toggle="modal"
                                data-target="#updateModal" data-link="/sales/{{$medicine->id}}/show">
                                <td>{{$medicine->id}}</td>
                                <td>
                                    {{ $medicine->name }}
                                </td>
                                <td>{{$medicine->quantity}}</td>
                                <td>{{$medicine->unit_price}}</td>
                                </tr>
                                @endforeach --> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="updateModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body " id="updateModal-body">
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
<form action="/sales/items" method="POST" id="medicine-form">
    @csrf
</form>

@endsection
