<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permission extends Model
{
    /**
     * Function delete permissions by id doctor
     *
     * @param int $id doctor id
     *
     * @return void
     */
    public function deletePermissionsByDoctorId($id){
        DB::table('permissions')->where('inFrom', '=', $id)->delete();
        return;
    }

    /**
     * Function create permissions
     *
     * @param int $id doctor id
     * @param array $permissions object permission
     *
     * @return void
     */
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
