<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;


class MainPageController extends Controller{

    /**
     * Controller public function for check which view to show the user
     *
     * @return view patient patient.blade.php, doctor  doctor.blade.php, welcome welcome.blade.php
     */
    public function index(){
        if(Auth::check()) {
            if(Auth::user()->idTypeUser==1){
                if(Input::has('startDate')){
                    $startDate = Input::get('startDate');
                    $endDate = Input::get('endDate');
                    $validators = Validator::make(
                        array(
                            'startDate' => $startDate,
                            'endDate' => $endDate,
                        ),
                        array(
                            'startDate' => 'required',
                            'endDate'   => 'required|after:startDate',
                        )
                    );
                    $errors = "";
                    $format = 'YYYY-MM-DD HH:mm';
                    if ($validators->fails()){
                        $errorMessage = $validators->messages();
                        foreach($errorMessage->all() as $messages){
                            $errors .= $messages. "\n";
                        }
                    }
                    if($errors==""){
                        $doctor = new Doctor;
                        $date = date_create($startDate);
                        $date2 = date_create($endDate);
                        $visits = $doctor->gerVisitsBetweenTime(Auth::user(), date_format($date, 'Y-m-d H:i:s'), date_format($date2, 'Y-m-d H:i:s'));

                        if(count($visits)>0) {
                            $sumHours = $doctor->gerDoctorWorkTime($visits);
                            return view("doctor", ['visits' => $visits, 'sumHours'=>$sumHours]);
                        }else{
                            return Redirect::to('home');
                        }
                    }else{
                        return View::make('doctor', array('visits' => [], 'errors' => isset($errors) ? $errors : null ));
                    }

                }else {
                    $doctor = new Doctor;
                    $visits = $doctor->gerVisits(Auth::user()->id);
                    return view("doctor", ['visits' => $visits]);
                }
            }else{
                $patient = new Patient;
                $visits = $patient->gerVisits(Auth::user()->id);
                return view("patient", ['visits' => $visits]);
            }
        }else{
            return view('welcome');
        }
    }
}