@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1>Medicine List</h1>
        <div>
            <form action="{{route('medicine.show')}}" method="POST" class="form-inline">
                @csrf
                <div class="form-group">
                    <input type="text" name="medicine_name" id="medincine_name" class="form-control" required placeholder="type medicine name here">
                </div>
                <button type="submit" class="btn btn-success ml-2">Search </button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-body p-0">
                    <table class="table" id="table">
                        <thead id="table-head">
                            <tr>
                                <th scope="col">Medicine #</th>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @foreach ($medicines as $medicine)
                            <tr>
                                <td scope="row">{{ $medicine->id }}</td>
                                <td>
                                    <a href="{{route('medicine.edit', $medicine->id)}}">{{$medicine->name}}</a>
                                </td>
                                <td>{{ $medicine->quantity }}</td>
                                <td>{{ $medicine->unit_price }}</td>
                                <td>
                                    @admin
                                    <form method="POST" action="{{route('medicine.destroy', $medicine->id)}}" class="form">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                    @endadmin
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $medicines->links() }}
                </div>
            </div>
        </div>
    </div>
    @endsection
