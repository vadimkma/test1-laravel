<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permission extends Model
{
    public function deletePermissionsByDoctorId($id){
        DB::table('permissions')->where('inFrom', '=', $id)->delete();
        return;
    }
    public function newPermissionsByDoctorId($id, $permissions){
        foreach ($permissions as $permission) {
            $newPermission = new Permission();
            $newPermission->inFrom = $id;
            $newPermission->inTo = intVal($permission);
            $newPermission->save();
        }
        return;
    }
}
