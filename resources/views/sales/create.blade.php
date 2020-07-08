@extends('layouts.base')

@section('custome-content')

<div class="container mt-4">
    <form action="{{route('medicine.store')}}" method="POST">
        @csrf
        <div class="form-row">
            @include('common.input', [
            'label' => 'Medicine Name',
            'name' => 'name',
            'required' => true,
            'autoFocus' => true,
            'type' => 'text'
            ])
            @include('common.input', [
            'label' => 'Quantity',
            'name' => 'quantity',
            'required' => true,
            'type' => 'number',
            'col' => 'col-md-4'
            ])

            @include('common.input', [
            'label' => 'Unit Price',
            'name' => 'unit_price',
            'required' => true,
            'type' => 'float',
            'col' => 'col-md-2'
            ])

        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-success">Save the medicine</button>
        </div>
    </form>

</div>

@endsection
