<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;

class Doctor extends Model
{
    /**
 * The table associated with the model.
 *
 * @var string
 */
    protected $table = 'users';

    public function gerVisits($id){
        $visits = DB::table('visits')->select('users.name', 'users.surname', 'visits.id', 'visits.startVisit', 'visits.endVisit', 'visits.comment', 'visits.active')
                   ->join('users', 'visits.idPatient', '=', 'users.id')
                    ->where('visits.idDoctor', '=', Auth::user()->id)->get();
        return $visits;
    }


    public function gerDoctorPermission($id){
        $doctors = DB::table('permissions')->select('users.name', 'users.surname', 'users.id')
            ->join('users', 'users.id', '=', 'permissions.inFrom')
            ->where('permissions.inTo', '=', $id)
            ->where('users.idTypeUser', '=', 1)
            ->get();
        return $doctors;
    }

    public function gerDoctorsListWithoutUser($id){
        $doctors = DB::table('users')->select('users.name', 'users.surname', 'users.id')
            ->where('users.idTypeUser', '=', 1)
            ->where('users.id', '<>', $id)
            ->get();
        $doctorArray=array();
        foreach($doctors as $doctor){
            $doctorArray[$doctor->id] = $doctor->name.' '.$doctor->surname;
        }
        return $doctorArray;
    }

    public function gerDoctorsUserPermissions($id){
        $doctorsSelected = DB::table('permissions')->select('users.name', 'users.surname', 'users.id')
            ->join('users', 'users.id', '=', 'permissions.inTo')
            ->where('users.idTypeUser', '=', 1)
            ->where('permissions.inFrom', '=', $id)
            ->get();
        $doctorsSelectedArray=array();
        foreach($doctorsSelected as $doctor){
            $doctorsSelectedArray[$doctor->id] = $doctor->id;
        }
        return $doctorsSelectedArray;
    }

    public function gerDoctorVisitById($id){
        $doctors = DB::table('permissions')->select('users.name', 'users.surname', 'users.id')
            ->join('users', 'users.id', '=', 'permissions.inFrom')
            ->where('users.idTypeUser', '=', 1)
            ->where('permissions.inFrom', '=', $id)
            ->count();
        if($doctors!=0){
            $visits = DB::table('visits')->select('users.name', 'users.surname', 'visits.id', 'visits.startVisit', 'visits.endVisit', 'visits.comment', 'visits.active')
                ->join('users', 'visits.idPatient', '=', 'users.id')
                ->where('visits.idDoctor', '=', $id)
                ->get();
            return $visits;
        }else{
            return false;
        }
    }

    public function gerVisitsBetweenTime($user, $startDate, $endDate){
        $visits = DB::table('visits')->select('users.name', 'users.surname', 'visits.id', 'visits.startVisit', 'visits.endVisit', 'visits.comment', 'visits.active')
            ->join('users', 'visits.idPatient', '=', 'users.id')
            ->where('visits.idDoctor', '=', $user->id)
            ->whereBetween('visits.startVisit', array($startDate, $endDate ))
            ->get();
        return $visits;
    }

    public function gerDoctorWorkTime($visits){
        $sumHours=0;
        foreach($visits as $visit){
            if($visit->active == false){
                continue;
            }
            $startDate = DateTime::createFromFormat('Y-m-d H:i:s', $visit->startVisit.'')->getTimestamp();
            $endDate = DateTime::createFromFormat('Y-m-d H:i:s', $visit->endVisit.'')->getTimestamp();
            $timeResult=$endDate-$startDate;
            $sumHours = $sumHours + $timeResult;


        }
        $sumHours = (int)($sumHours / 3600);
        return $sumHours;
    }


}
