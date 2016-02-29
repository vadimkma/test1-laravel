<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class patient extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';


    /**
     * Function get visits by patient id
     *
     * @param int $id patient id
     *
     * @return $visits array visits
     */
    public function gerVisits($id){
        $visits = DB::table('visits')->select('users.name', 'users.surname', 'visits.id', 'visits.startVisit', 'visits.endVisit', 'visits.comment', 'visits.active')
            ->join('users', 'visits.idDoctor', '=', 'users.id')
            ->where('visits.idPatient', '=', $id)
            ->orderBy('visits.startVisit', 'asc')
            ->get();
        return $visits;
    }

    /**
     * Function get doctor patients list
     *
     * @param int $id patient id
     *
     * @return $patients array patients
     */
    public function gerPatientsList($id){
        $patients = DB::table('users')->select('users.name', 'users.surname', 'users.id')
            ->where('users.idDoctor', '=', $id)
            ->get();
        return $patients;
    }

    /**
     * Function get patient visits by id
     *
     * @param int $id patient id
     * @param int $idUser doctor id
     *
     * @return $visits array visits
     */
    public function getPatientVisits($id, $idUser){
        $visits = DB::table('visits')->select('users.name', 'users.surname', 'visits.id', 'visits.startVisit', 'visits.endVisit', 'visits.comment', 'visits.active')
            ->join('users', 'visits.idPatient', '=', 'users.id')
            ->where('visits.idDoctor', '=', $idUser)
            ->where('visits.idPatient', '=', $id)
            ->orderBy('visits.startVisit', 'asc')
            ->get();
        return $visits;
    }
}
