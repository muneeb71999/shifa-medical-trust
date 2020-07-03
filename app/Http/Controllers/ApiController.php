<?php

namespace App\Http\Controllers;

use App\Patients;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getPatients()
    {
        $patientsCurrentMonth = Patients::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        return json_encode($patientsCurrentMonth);
    }

    public function getPatientsList($name)
    {
        $patients = Patients::where('name', 'LIKE', '%' . $name . '%')->orderBy('name', 'desc')->get();

        $patients = $this->reformateDate($patients);

        return json_encode([
            'stauts' => 200,
            'count' => count($patients),
            'patients' => $patients
        ]);
    }

    public function getOnePatient(Patients $patient)
    {
        $patientData = $patient;
        $patientData['doctor'] = $patientData->doctor->name;
        $patientData['user'] = $patientData->user->name;
        return $patientData;
    }
}
