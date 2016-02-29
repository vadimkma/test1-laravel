<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    /**
     * Controller public function authorization  user
     *
     * @return redirect to home or view login auth.login.blade.php
     */
    public function login(){
        if(Auth::check()) {
            return Redirect::intended('home');
        }

        $user = new User();
        if(Input::has('login')){
            $login = Input::get('login');
            $password = Input::get('password');
            $remember = Input::has('remember') ? true : false;

            $validators = Validator::make(
                array(
                    'login' => $login,
                    'password' => $password,

                ),
                array(
                    'login' => 'required|min:2|max:30',
                    'password' => 'required|min:2|max:30',
                )
            );
            $errors = "";
            $success = "";
            if ($validators->fails()){
                $errorMessage = $validators->messages();
                foreach($errorMessage->all() as $messages){
                    $errors .= $messages. "<br>";
                }
            }else{
                if (Auth::attempt(['login' => $login, 'password' => $password], $remember, true)){
                    return Redirect::intended('home');
                }else{
                    $errors="error login or password";
                }
            }
        }
        return View::make('auth.login', array('title' => 'user sign up',
            'errors' => isset($errors) ? $errors : null ,
            'success' => isset($success) ? $success : null ));
    }

    /**
     * Controller public function registration doctor
     *
     * @return redirect to home or view register form auth.doctorSignUp.blade.php
     */
    public function doctor(){
        if(Auth::check()) {
            return Redirect::intended('home');
        }

        $user = new User();
        if(Input::has('login')){
            $name = Input::get('name');
            $surname = Input::get('surname');
            $login = Input::get('login');
            $password = Input::get('password');
            $idTypeUser = intVal(Input::get('idTypeUser'));

            $validators = Validator::make(
                array(
                    'name' => $name,
                    'surname' => $surname,
                    'login' => $login,
                    'password' => $password,
                    'password_confirmation' => Input::get('password_confirmation'),
                    'idTypeUser' => $idTypeUser,
                ),
                array(
                    'name' => 'required|min:2|max:30',
                    'surname' => 'required|min:2|max:30',
                    'login' => 'required|unique:users,login|min:2|max:30',
                    'password' => 'required|confirmed||min:2|max:30',
                    'password_confirmation' => 'same:password',
                    'idTypeUser' => 'required|min:1|max:1',
                )
            );
            $errors = "";
            $success = "";
            if ($validators->fails()){
                $errorMessage = $validators->messages();

                foreach($errorMessage->all() as $messages){
                    $errors .= $messages. "<br>";
                }
            }else{
                $user->fill(Input::all());
                if($user->signup()) {
                    if (Auth::attempt(['login' => $login, 'password' => $password], true, true)) {
                        return Redirect::intended('home');
                    }
                }
            }
        }
        return View::make('auth.doctorSignUp', array('title' => 'doctor register',
            'errors' => isset($errors) ? $errors : null ,
            'success' => isset($success) ? $success : null ));
    }


    /**
     * Controller public function registration patient
     *
     * @return redirect to home or view register form auth.patientSignUp.blade.php
     */
    public function patient(){
        if(Auth::check()) {
            return Redirect::intended('home');
        }

        $user = new User();
        if(Input::has('login')){
            $name = Input::get('name');
            $surname = Input::get('surname');
            $login = Input::get('login');
            $password = Input::get('password');
            $idDoctor = Input::get('idDoctor');
            $idTypeUser = intVal(Input::get('idTypeUser'));

            $validators = Validator::make(
                array(
                    'name' => $name,
                    'surname' => $surname,
                    'login' => $login,
                    'password' => $password,
                    'password_confirmation' => Input::get('password_confirmation'),
                    'idTypeUser' => $idTypeUser,
                    'idDoctor' => $idDoctor,
                ),
                array(
                    'name' => 'required|min:2|max:30',
                    'surname' => 'required|min:2|max:30',
                    'login' => 'required|unique:users,login|min:2|max:30',
                    'password' => 'required|confirmed||min:2|max:30',
                    'password_confirmation' => 'same:password',
                    'idTypeUser' => 'required|min:1|max:1',
                    'idDoctor' => 'required|min:1',
                )
            );
            $errors = "";
            $success = "";
            if ($validators->fails()){
                $errorMessage = $validators->messages();

                foreach($errorMessage->all() as $messages){
                    $errors .= $messages. "<br>";
                }
            }else{
                $user->fill(Input::all());
                if($user->signupPatient()) {
                    if (Auth::attempt(['login' => $login, 'password' => $password], true, true)) {
                        return Redirect::intended('home');
                    }
                }
            }
        }
        $doctors = DB::table('users')
            ->select('id', 'name', 'surname')
            ->where('idTypeUser', '=', 1)->get();
        $doctorArray=array();
        foreach($doctors as $doctor){
            $doctorArray[$doctor->id] = $doctor->name.' '.$doctor->surname;
        }
        return View::make('auth.patientSignUp', array('title' => 'patient register',
            'errors' => isset($errors) ? $errors : null ,
            'success' => isset($success) ? $success : null,
            'doctors' => isset($doctorArray) ? $doctorArray : null ));
    }

}