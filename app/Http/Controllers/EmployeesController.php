<?php

namespace App\Http\Controllers;

use App\Employees;
use App\TokenNumber;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $employees = Employees::all();
        $users = User::all();

        return view('employees.index', [
            'page_title' => 'Employees Page',
            'page_url' => '/employees/create',
            'btn_title' => 'Hire New Employee',
            'employees' => $employees,
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('employees.create', [
            'page_title' => "New Employees",
            'page_url' => "/employees",
            'btn_title' => "Back",
        ]);
    }

    public function store()
    {
        DB::transaction(function () {

            $validatedFields = request()->validate([
                'name' => 'required',
                'age' => 'required',
                'gender' => 'required',
                'guardian_name' => 'required',
                'monthly_salary' => 'required',
                'designation' => 'required',
                'cnic' => 'required',
                'education' => 'required',
                'phone' => 'required',
                'address' => 'required'
            ]);

            $employee = Employees::create($validatedFields);

            if ($employee->designation === 'doctor' || $employee->designation === 'Doctor') {
                TokenNumber::create([
                    'employee_id' => $employee->id,
                ]);
            }
        });

        return redirect(route('employees.index'));
    }

    public function destroy(Employees $employee)
    {
        $employee->delete();
        return redirect(route('employees.index'));
    }

    public function show(Employees $employee)
    {
        return $employee;
    }
}
