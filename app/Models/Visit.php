<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use Illuminate\Support\Facades\DB;

class Visit extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'visits';

    public function getVisit($id){
        $visit = Visit::find($id);
        return $visit;
    }

    public function cancelVisit($id){
        $visit = Visit::find($id);
        $visit->active = false;
        $visit->save();
        return;
    }
    public function saveCommentVisit($id,$comment){
        $visit = Visit::find($id);
        $visit->comment=$comment;
        $visit->save();
        return;
    }
    public function createVisit( $user, $date, $date2, $active ){
        $visit = new Visit;
        $visit->idDoctor=$user->idDoctor;
        $visit->idPatient=$user->id;
        $visit->startVisit=date_format($date, 'Y-m-d H:i:s');
        $visit->endVisit=$date2->format('Y-m-d H:i:s');
        $visit->active=true;
        $visits = $visit->checkBusyDoctor( );

        if($visits == 0){
            $visit->save();
        }else{
            return "doctor busy";
        }
        return "";
    }

    public function checkBusyDoctor( ){
        $visits = DB::table('visits')->select('users.name', 'users.surname', 'visits.id', 'visits.startVisit', 'visits.endVisit', 'visits.comment', 'visits.active')
            ->join('users', 'visits.idPatient', '=', 'users.id')
            ->where('visits.idDoctor', '=', $this->idDoctor)
            ->where('visits.active', '=', 1)
            ->whereBetween('visits.startVisit', array($this->startVisit, $this->endVisit ))
            ->whereBetween('visits.endVisit', array($this->startVisit, $this->endVisit ))
            ->count();
        return $visits;
    }



}
