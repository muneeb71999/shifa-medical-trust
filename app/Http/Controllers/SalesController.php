<?php

namespace App\Http\Controllers;

use App\Medicines;
use App\SaleInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $medicines = Medicines::all();

        return view('sales.index', [
            'page_title' => 'Pharamacy',
            'page_url' => route('medicine.index'),
            'btn_title' => 'Add Medicine',
            'medicines' => $medicines
        ]);
    }

    public function create()
    {
        return view('sales.create', [
            'page_title' => 'Add New Medicine',
            'page_url' => '/sales',
            'btn_title' => 'Back'
        ]);
    }

    public function storeItems(Request $request)
    {
        $total_price  = 0;

        // Count the total price
        for ($i = 0; $i < count($request->get('id')); $i++) {
            $total_price += $request->get('unit_price')[$i] * $request->get('quantity')[$i];
        }

        DB::beginTransaction();
        try {
            // Add record into the sales_invoice table
            $invoiceId = DB::table('sale_invoices')->insertGetId(
                ['total_price' => $total_price,]
            );

            // Update medicine data and insert into sales table
            for ($i = 0; $i < count($request->get('id')); $i++) {
                // Extract id and purchased quantity
                $medicine_id = $request->get('id')[$i];
                $purchased_quantity = $request->get('quantity')[$i];
                $unit_price = $request->get('unit_price')[$i];

                // Get the medicine and update it
                DB::update('update medicines set quantity = quantity - ?  where id = ?', [$purchased_quantity, $medicine_id]);

                // Insert into sales table
                DB::insert('insert into sales (medicine_id, quantity, unit_price, invoice_id, user_id) values (?, ?, ?, ?, ?)', [$medicine_id, $purchased_quantity, $unit_price, $invoiceId, auth()->user()->id]);
            }
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'an error occured while saving data',
            ], 400);
        }
        DB::commit();
        return response()->json([
            'status' => 'success',
            'invoiceId' => $invoiceId
        ], 201);
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

    public function show(Medicines $medicine)
    {
        return $medicine;
    }

    public function search($search)
    {
        return Medicines::where('name', 'LIKE', $search . '%')->get();
    }

    public function print($id)
    {

        $invoice = SaleInvoice::find($id);
        $medicine = $invoice->sales;
        return view('sales.invoice', [
            'products' => $medicine,
            'total_price' => $invoice->total_price,
            'invoice' => $invoice,
            'total_items' => count($medicine)
        ]);
    }

    public function list()
    {
        $sales = SaleInvoice::paginate(30);
        $total_price = 0;
        foreach ($sales as $sale) {

            $total_price += $sale->total_price;
        }
        return view('sales.list', [
            'page_title' => "Sale Record List",
            'page_url' => route('sales.index'),
            'btn_title' => "Go Back",
            'sales' => $sales,
            'total_price' => $total_price
        ]);
    }

    public function destroy(SaleInvoice $sale)
    {
        $sale->delete();
        return redirect(route('sales.list'));
    }
}
