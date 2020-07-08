<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicines;

class MedicinesController extends Controller
{

    public function index()
    {
        return view('medicines.create', [
            'page_title' => "Add New Medicine to Record",
            'page_url' => route('sales.index'),
            'btn_title' => 'Go Back'
        ]);
    }

    public function destroy(Medicines $medicine)
    {
        $medicine->delete();
        return redirect(route('medicines.list'));
    }

    public function store()
    {
        try {
            $validateFields = request()->validate([
                'name' => 'required',
                'unit_price' => 'required',
                'quantity' => 'required'
            ]);

            $medicine = Medicines::create($validateFields);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }

        return redirect(route('sales.medicine'));
    }

    public function list()
    {
        $medicine = Medicines::paginate(30);

        return view('medicines.list', [
            'medicines' => $medicine
        ]);
    }

    public function show()
    {
        $name = request()->get('medicine_name');
        $medicines = Medicines::where('name', "LIKE", "$name%")->paginate(30);
        return view('medicines.list', [
            'medicines' => $medicines
        ]);
    }

    public function edit(Medicines $medicine)
    {
        return view('medicines.edit', [
            'page_title' => "Edit Medicine Record",
            'page_url' => route('medicine.list'),
            'btn_title' => 'Go Back',
            'medicine' => $medicine
        ]);
    }

    public function update(Medicines $medicine)
    {
        $validateFields = request()->validate([
            'name' => 'required',
            'unit_price' => 'required',
            'quantity' => 'required'
        ]);

        $medicine->update($validateFields);
        return redirect(route('medicine.list'));
    }
}
