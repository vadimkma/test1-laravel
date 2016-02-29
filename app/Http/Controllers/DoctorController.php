<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class DoctorController extends Controller
{

    /**
     * Controller public function get all doctors list
     *
     * @return view doctorsList doctorsList.blade.php
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
     * Controller public function get doctor visits list
     *
     * @param int $id doctor id
     *
     * @return view doctorView doctorView.blade.php
     */
    public function doctorVisits($id)
    {
        if(Auth::check()) {
            if (Auth::user()->idTypeUser == 1) {
                $doctor = new Doctor();
                $visits = $doctor->gerDoctorVisitById($id);
                if($visits == false){
                    return Redirect::intended('home');
                }

                return view("doctorView", ['visits' => $visits]);

            } else {
                return Redirect::intended('home');
            }
        }
        return Redirect::intended('home');
    }
}