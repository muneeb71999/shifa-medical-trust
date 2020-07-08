<?php

namespace App\Http\Controllers;

use App\Employees;
use App\Patients;
use App\TokenNumber;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;

class PatientsController extends Controller
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

    public function index()
    {
        // Get the patients list
        $patients = Patients::whereMonth('created_at', Date('m'))->whereYear('created_at', Date('Y'))->orderBy('created_at', 'desc')->paginate(30);
        // $patients = Patients::all();
        // dd($patients);
        // Reformate the date
        $patients = $this->reformateDate($patients);
        // DB::raw("select * from patients where MONTH(created_at) = ? AND YEAR(created_at) = ? ORDER BY created_at DESC", [Date('m'), Date('Y')]);
        // Return the view with the data
        return view('patients.index', [
            'page_title' => "Patients Page",
            'page_url' => "/patients/create",
            'btn_title' => "New Patients",
            'patients' => $patients
        ]);
    }

    public function create()
    {

        $options = [];

        $employees = Employees::where('designation', 'doctor')->get();

        foreach ($employees as $doctor) {
            array_push($options, [
                'name' => $doctor->name,
                'value' => $doctor->id
            ]);
        }

        return view('patients.create', [
            'page_title' => "Add New Patients",
            'page_url' => "/patients",
            'btn_title' => "Back",
            'options' => $options
        ]);
    }

    public function store()
    {

        DB::beginTransaction();
        try {
            $validatedFields = request()->validate([
                'name' => 'required',
                'age' => 'required',
                'relation' => 'required',
                'gender' => 'required',
                'guardian_name' => '',
                'fee' => 'required',
                'phone' => '',
                'doctor_id' => 'required'
            ]);

            if (isset($validatedFields['guardian_name'])) {
                // Reset the name attribute
                $validatedFields['name'] = $validatedFields['name'] . ' ' .  $validatedFields['relation'];
            }

            // Unset the relation attribute
            unset($validatedFields['relation']);

            // Append the current user_id
            $validatedFields['user_id'] = auth()->user()->id;

            //
            $token = TokenNumber::where('employee_id', $validatedFields['doctor_id'])->first();

            // Current DateTime Object
            $currentDate = new Carbon();

            // Generate the interval object from the DateTime interval
            $timeInterval = date_diff($token->created_at, $currentDate, true);

            if ($timeInterval->d === 0) {
                if ($timeInterval->i * $timeInterval->h >= 300) {
                    $token->created_at = $currentDate;
                    $token->token_number = 0;
                }
            } else if ($timeInterval->i * $timeInterval->h * $timeInterval->d * 24 >= 300) {
                $token->created_at = $currentDate;
                $token->token_number = 0;
            }

            $token->save();

            // Generate the current Doctors Token number
            DB::update('update token_numbers set token_number = (token_number+1) where employee_id = ?', [$validatedFields['doctor_id']]);

            // Insert the token number into patients
            $validatedFields['token'] = $token->token_number + 1;

            // Add the record to the database
            $patient = Patients::create($validatedFields);
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
        DB::commit();
        return redirect(route('patients.print', $patient->id));
    }

    public function edit(Patients $patient)
    {
        $validatedFields = request()->validate([
            'name' => 'required',
            'age' => 'required',
            'relation' => 'required',
            'gender' => 'required',
            'guardian_name' => '',
            'fee' => 'required',
            'phone' => '',
            'doctor_id' => 'required'
        ]);


        // Reset the name attribute
        $validatedFields['name'] = $validatedFields['name'] . ' ' .  $validatedFields['relation'];

        // Unset the relation attribute
        unset($validatedFields['relation']);

        // Append the current user_id
        $validatedFields['user_id'] = auth()->user()->id;
        $validatedFields['token'] = 5;

        // Update the record to the database
        $patient->update($validatedFields);

        // Redirect to the current Route
        return redirect(Route::current());
    }

    public function destroy(Patients $patient)
    {
        $patient->delete();
        return redirect(route('patients.index'));
    }

    public function print(Patients $patient)
    {
        return view('patients.print', [
            'patient' => $patient
        ]);
    }

    public function show(Patients $patient)
    {
        return $patient;
    }

    public function printAndSave(Patients $patient)
    {

        DB::beginTransaction();
        try {
            $token = TokenNumber::where('employee_id', $patient->doctor_id)->first();

            $token->token_number = $token->token_number + 1;
            $token->save();
            $patient->token = $token->token_number;

            $patient = $patient->attributesToArray();
            unset($patient['created_at']);
            unset($patient['id']);
            $patient = Patients::create($patient);

            DB::commit();
            return view('patients.print', [
                'patient' => $patient
            ]);
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
        DB::commit();
    }

    public function getPatientsList($name)
    {
        $patients = Patients::where('name', 'LIKE', $name . '%')->orderBy('name', 'asc')->get();

        $patients = $this->reformateDate($patients);

        return json_encode([
            'stauts' => 200,
            'count' => count($patients),
            'patients' => $patients
        ]);
    }

    public function getPatients()
    {
        $patientsCurrentMonth = Patients::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        return json_encode($patientsCurrentMonth);
    }

    private function reformateDate($patients)
    {
        foreach ($patients as $patient) {
            $patient->created_at = date('d-m-Y / g:i:A', strtotime($patient->created_at));
        }
        return $patients;
    }
}
