<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class PatientController extends Controller{

    /**
     *
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
     *
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