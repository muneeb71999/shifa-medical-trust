<?php

namespace App\Http\Controllers;

use App\Employees;
use Illuminate\Http\Request;
use App\Patients;
use App\SaleInvoice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $patientsCurrentMonth = Patients::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();

        $employeeSalary = Employees::all()->sum('monthly_salary');

        $medicineSale = SaleInvoice::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();

        $total_medicine_sale = 0;
        foreach ($medicineSale as $sale) {
            $total_medicine_sale += $sale->total_price;
        }

        return view('home', [
            'totalPatients' => $patientsCurrentMonth,
            'employeesSalary' => $employeeSalary,
            'medicineSale' => $total_medicine_sale,
        ]);
    }
}
