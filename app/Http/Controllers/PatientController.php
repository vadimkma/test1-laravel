<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class PatientController extends Controller{

    /**
     * Controller public function get patients list
     *
     * @return view patientList patientList.blade.php
     */
    public function patientsList(){
        if(Auth::check()) {
            if (Auth::user()->idTypeUser == 1) {
                $patient = new Patient();
                $patients = $patient->gerPatientsList(Auth::user()->id);
                return view("patientList", ['patients' => $patients]);
            } else {
                return Redirect::intended('home');
            }
        }
        return Redirect::intended('home');
    }

    /**
     * Controller public function get patient visits list by id patient
     *
     * @param int $id patient id
     *
     * @return view patientVisits patientVisits.blade.php
     */
    public function patientVisits($id){
        if(Auth::check()) {
            if (Auth::user()->idTypeUser == 1) {
                $patient = new Patient();
                $visits = $patient->getPatientVisits($id, Auth::user()->id);
                return view("patientVisits", ['visits' => $visits]);
            } else {
                return Redirect::intended('home');
            }
        }
        return Redirect::intended('home');
    }

}