<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'surname', 'login', 'password', 'idTypeUser', 'idDoctor', 'remember_token' ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Function save doctor in database
     *
     * @return boolean
     */
    public function signup(){
        $this->password = Hash::make($this->password);
        return $this->save();
    }


    /**
     * Function save patient in database
     *
     * @return boolean
     */
    public function signupPatient(){
        $this->password = Hash::make($this->password);
        return $this->save();
    }

}
