<?php

namespace App\Http\Controllers;

use App\Patients;
use App\SaleInvoice;
use App\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('audit.index', [
            'page_title' => "Generate Reports"
        ]);
    }

    public function showPatients()
    {

        $patients = Patients::whereBetween('id', [request()->get('starting_invoice'), request()->get('ending_invoice')])->get();

        $total_amount = 0;
        $free_patients = 0;

        foreach ($patients as $patient) {
            if ($patient->fee === 0 || $patient->fee == null) {
                $free_patients += 1;
            } else {
                $total_amount += $patient->fee;
            }
        }

        return view('audit.list', [
            'patients' => $patients,
            'total_amount' => $total_amount,
            'total_patients' => count($patients),
            'free_patients' => $free_patients,
            'paid_patients' => count($patients) - $free_patients,
            'starting_invoice' => request()->get('starting_invoice'),
            'ending_invoice' => request()->get('ending_invoice')
        ]);
    }

    public function showMedicine()
    {
        $total_amount = 0;

        $sales = SaleInvoice::whereBetween('id', [request()->get('starting_invoice'), request()->get('ending_invoice')])->get();

        foreach ($sales as $sale) {
            $total_amount += $sale->total_price;
        }


        return view('audit.salesList', [
            'sales' => $sales,
            'total_amount' => $total_amount,
            'total_sales' => count($sales),
            'starting_invoice' => request()->get('starting_invoice'),
            'ending_invoice' => request()->get('ending_invoice')
        ]);
    }
}
