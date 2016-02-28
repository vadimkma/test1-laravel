<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Permission;



class PermissionController extends Controller
{

    /**
     *
     */
    public function index()
    {
        if(Auth::check()) {
            if (Auth::user()->idTypeUser == 1) {
                $doctor = new Doctor();
                $doctors = $doctor->gerDoctorsListWithoutUser(Auth::user()->id);
                $doctorsSelected = $doctor->gerDoctorsUserPermissions(Auth::user()->id);
                return view("permissions", ['doctors' => $doctors, 'doctorsSelected' => $doctorsSelected]);
            }
        }
        return Redirect::intended('home');
    }

    public function create(){
        if(Auth::check()) {
            if (Auth::user()->idTypeUser == 1) {
                $permission = new Permission();
                $permission->deletePermissionsByDoctorId(Auth::user()->id);
                $permissions = Input::get('permissions');
                $permission->newPermissionsByDoctorId(Auth::user()->id, $permissions);
                return Redirect::intended('home');
            }
        }
        return Redirect::intended('home');
    }
}