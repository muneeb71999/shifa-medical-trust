<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        return ['name' => "Muneeb Akram"];
    }
}