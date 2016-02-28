<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class DoctorController extends Controller
{

    /**
     *
     */
    public function doctorsList()
    {
        if(Auth::check()) {
            if (Auth::user()->idTypeUser == 1) {
                $doctor=new Doctor();
                $doctors=$doctor->gerDoctorPermission(Auth::user()->id);
                return view("doctorsList", ['doctors' => $doctors]);
            }else {
                return Redirect::intended('home');
            }
        }
        return Redirect::intended('home');
    }

    /**
     *
     */
    public function doctorVisits($id)
    {
        if(Auth::check()) {
            if (Auth::user()->idTypeUser == 1) {
                $doctor = new Doctor();
                $visits = $doctor->gerDoctorVisitById($id);
                if ($visits != false) {
                    return view("doctorView", ['visits' => $visits]);
                } else {
                    return Redirect::intended('home');
                }
            } else {
                return Redirect::intended('home');
            }
        }
        return Redirect::intended('home');
    }
}