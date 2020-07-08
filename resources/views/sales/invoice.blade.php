@extends('layouts.app')

@section('content')

<div class="row">
    <div class="ml-2 col-md-4">
        <div class="card">
            <div class="card-header text-center">
                <div class="h5 font-weight-bold">Shifa Medical Trust</div>
                <p class="text-capitalize m-n2">{{config('app.address')}}</p>
                <div class="d-flex justify-content-between alig-items-center mt-2">
                    <div>
                        <span class="font-weight-bold">Invoice# &nbsp;</span>
                        {{$invoice->id}}
                    </div>
                    <div>
                        {{$invoice->created_at}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="table-head">
                        <tr>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach ($products as $product)
                        <tr>
                            <td>{{$product->medicine->name}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->unit_price}}</td>
                            <td>{{$product->unit_price * $product->quantity}}</td>
                        </tr>
                        {{-- <h1>{{$product->medicine[0]->name}}</h1> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer ">
                <div class="d-flex justify-content-between align-items-center" style="font-size: 14px">
                    <div>
                        Total Items
                        <span class="ml-5">{{$total_items}}</span>
                    </div>
                    <div>
                        {{$products[0]->user->name}}
                    </div>
                </div>

                <div class="h-5 d-flex justify-content-between align-items-center font-weight-bold">
                    <div>Total Price</div>
                    <div>{{$total_price}}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.print();
        setTimeout(() => {
            window.location.href = "http://127.0.0.1:8000/sales";
        }, 1500);
    })
</script>

@endsection
