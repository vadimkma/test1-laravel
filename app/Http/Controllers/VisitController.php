<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use DateTime;
//use Faker\Provider\DateTime;


class VisitController extends Controller{

    public function index(){

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $visit = new Visit();
            $visit = $visit->getVisit($id);

            if (Input::has('comment')) {
                $comment = Input::get('comment');
                $validators = Validator::make(
                    array(
                        'comment' => $comment
                    ),
                    array(
                        'comment' => 'max:255',
                    )
                );
                $errors = "";
                if ($validators->fails()) {
                    $errorMessage = $validators->messages();
                    foreach ($errorMessage->all() as $messages) {
                        $errors .= $messages . "<br>";
                    }
                } else {
                    $visit->saveCommentVisit($id, $comment);
                    return Redirect::to('home');
                }
            }
            return View::make('visitEdit', array('visit' => $visit,
                'errors' => isset($errors) ? $errors : null));
        }
        return Redirect::to('home');
    }


    public function cancel($id)
    {
        if(Auth::check()) {
            $visit = new Visit();
            $visit->cancelVisit($id);
        }
        return Redirect::to('home');
    }

    public function create()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $visit = new Visit;

            if (Input::has('startDate')) {
                $startDate = Input::get('startDate');
                $buf_time = Input::get('time');

                $validators = Validator::make(
                    array(
                        'startDate' => $startDate,
                        'time' => $buf_time,
                    ),
                    array(
                        'startDate' => 'required',
                        'time' => 'required',
                    )
                );
                $errors = "";
                if ($validators->fails()) {
                    $errorMessage = $validators->messages();
                    foreach ($errorMessage->all() as $messages) {
                        $errors .= $messages . "<br>";
                    }
                }

                if ($errors == "") {
                    $duf_startDate = DateTime::createFromFormat('Y-m-d H:i', $startDate)->getTimestamp();
                    $time = DateTime::createFromFormat('Y-m-d H:i', '1970-01-01 ' . $buf_time)->getTimestamp();

                    $date = date_create($startDate);
                    $date2 = new DateTime();
                    $date2->setTimestamp($time + $duf_startDate);

                    $visit = new Visit;
                    $errors .= $visit->createVisit(Auth::user(), $date, $date2, true);
                    if ($errors == "") {
                        return Redirect::to('home');
                    }
                }
            }

            return View::make('visitCreate', array('user' => $user,
                'errors' => isset($errors) ? $errors : null));
        }
        return Redirect::to('home');
    }



}