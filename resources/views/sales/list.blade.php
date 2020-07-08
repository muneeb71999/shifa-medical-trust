@extends('layouts.base')

@section('custome-content')
<h2 class="card-header"> Total Price : <span class="ml-5 font-weight-bold">{{$total_price}} </span></h2>
<div class="row">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-body p-0">
                <table class="table" id="table">
                    <thead id="table-head">
                        <tr>
                            <th scope="col">Invoice #</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Medicine</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($sales as $sale)
                        <tr>
                            <td scope="row">{{ $sale->id }}</td>
                            <td>
                                {{$sale->total_price}}
                            </td>
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
                            <td>
                                {{-- @admin
                                    <form method="POST" action="{{route('sales.destroy', $sale->id)}}" class="form">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    Delete
                                </button>
                                </form>
                                @endadmin --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $sales->links() }}
            </div>
        </div>
    </div>
    @endsection
