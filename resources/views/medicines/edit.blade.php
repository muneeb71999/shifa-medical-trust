@extends('layouts.base')

@section('custome-content')
<div class="container mt-4">
    <form action="{{route('medicine.update', $medicine->id)}}" method="POST">
        @csrf
        <div class="form-row">
            @include('common.input', [
            'label' => 'Medicine Name',
            'name' => 'name',
            'required' => true,
            'autoFocus' => true,
            'type' => 'text',
            'value' => $medicine->name
            ])
            @include('common.input', [
            'label' => 'Quantity',
            'name' => 'quantity',
            'required' => true,
            'type' => 'number',
            'col' => 'col-md-4',
            'value' => $medicine->quantity
            ])

            @include('common.input', [
            'label' => 'Unit Price',
            'name' => 'unit_price',
            'required' => true,
            'type' => 'float',
            'col' => 'col-md-2',
            'value' => $medicine->unit_price
            ])

        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-success">Update the medicine</button>
        </div>
    </form>
</div>
@endsection
