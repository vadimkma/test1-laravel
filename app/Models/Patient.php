<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class patient extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';


    public function gerVisits($id){
        $visits = DB::table('visits')->select('users.name', 'users.surname', 'visits.id', 'visits.startVisit', 'visits.endVisit', 'visits.comment', 'visits.active')
            ->join('users', 'visits.idDoctor', '=', 'users.id')
            ->where('visits.idPatient', '=', Auth::user()->id)->get();
        return $visits;
    }

    public function gerPatientsList($id){
        $patients = DB::table('users')->select('users.name', 'users.surname', 'users.id')
            ->where('users.idDoctor', '=', $id)
            ->get();
        return $patients;
    }

    public function getPatientVisits($id, $idUser){
        $visits = DB::table('visits')->select('users.name', 'users.surname', 'visits.id', 'visits.startVisit', 'visits.endVisit', 'visits.comment', 'visits.active')
            ->join('users', 'visits.idPatient', '=', 'users.id')
            ->where('visits.idDoctor', '=', $idUser)
            ->where('visits.idPatient', '=', $id)
            ->get();
        return $visits;
    }
}
