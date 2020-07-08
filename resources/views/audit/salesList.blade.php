@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h1>Audit Medicine List</h1>
        <div>
            <a href="/audit" class="btn btn-success ">Back</a>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header p-0 ">
            <table class="table" id="table">
                <thead id="table-head">
                    <tr>
                        <th scope="col">Invoice #</th>
                        <th scope="col">Total Sales</th>
                        <th scope="col">Total Income</th>
                    </tr>

                </thead>
                <tbody id="table-body">
                    <tr>
                        <td scope="row">{{ $starting_invoice . ' - ' . $ending_invoice }}</td>
                        <td>
                            {{$total_sales}}
                        </td>
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
                        <th scope="col">Total</th>
                        <th scope="col">Medicine</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($sales as $sale)
                    <tr>
                        <td scope="row">{{ $sale->id }}</td>
                        <td>{{ $sale->total_price }}</td>
                        <td>
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sale->sales as $saleItem)
                                    <tr>
                                        <td>{{$saleItem->medicine->name}}</td>
                                        <td>{{$saleItem->quantity}}</td>
                                        <td>{{$saleItem->unit_price}}</td>
                                        <td>{{$saleItem->unit_price * $saleItem->quantity}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <td>{{ $sale->created_at}}</td>
                        {{-- <td>{{ $sale->fee }}</td>--}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
