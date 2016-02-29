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

    /**
     * Function check access to get visit by id
     *
     * @param int $id visit id
     * @param int $idUser
     *
     * @return boolean
     */
    public function checkAccessDoctorVisit($id, $idUser){
        $countVisits = DB::table('visits')->select('visits.id', 'visits.comment', 'visits.active')
            ->where('visits.id', '=', $id)
            ->where('visits.idDoctor', '=', $idUser)
            ->count();
        return ( $countVisits == 0 );
    }

    /**
     * Function check access to get visit by id
     *
     * @param int $id visit id
     * @param int $idUser
     *
     * @return boolean
     */
    public function checkAccessVisit($id, $idUser){
        $countVisits = DB::table('visits')->select('visits.id', 'visits.comment', 'visits.active')
            ->where('visits.id', '=', $id)
            ->where('visits.idDoctor', '=', $idUser)
            ->orwhere('visits.idPatient', '=', $idUser)
            ->count();
        return ( $countVisits == 0 );
    }

    /**
     * Function get visit by id
     *
     * @param int $id visit id
     *
     * @return $visit
     */
    public function getVisit($id){
        $visit = Visit::find($id);
        return $visit;
    }

    /**
     * Function cancel visit by id
     *
     * @param int $id visit id
     *
     * @return void
     */
    public function cancelVisit($id){
        $visit = Visit::find($id);
        $visit->active = false;
        $visit->save();
        return;
    }

    /**
     * Function save comment by id visit
     *
     * @param int $id visit id
     * @param string $comment
     *
     * @return void
     */
    public function saveCommentVisit($id,$comment){
        $visit = Visit::find($id);
        $visit->comment=$comment;
        $visit->save();
        return;
    }

    /**
     * Function save comment by id visit
     *
     * @param user $user its patient
     * @param DateTime $date its start date visit
     * @param DateTime $date2 its end date visit
     *
     * @return string message
     */
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

    /**
     * Function check busy doctor between two date
     *
     *
     * @return array $visits
     */
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
