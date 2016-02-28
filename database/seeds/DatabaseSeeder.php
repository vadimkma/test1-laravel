<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeUser;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Support\Facades\Hash;
use App\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call('TypeUserSeeder');
        $this->call('DoctorSeeder');
        $this->call('PatientSeeder');
        $this->call('VisitsSeeder');
        $this->call('PermissionSeeder');
        // $this->call(UsersTableSeeder::class);
    }
}

class TypeUserSeeder extends Seeder{

    /**
     * Run the TypeUserSeeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_users')->delete();
        DB::table('type_users')->truncate();
        TypeUser::create([
           'name' => 'doctor'
        ]);
        TypeUser::create([
            'name' => 'patient'
        ]);
    }
}

class DoctorSeeder extends Seeder{

    /**
     * Run the DoctorSeeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->truncate();
        User::create([
            'idTypeUser' => 1,
            'name' => 'Emil',
            'surname' => 'Grant',
            'login' => 'grant',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'idTypeUser' => 1,
            'name' => 'Brian',
            'surname' => 'Hart',
            'login' => 'hart',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'idTypeUser' => 1,
            'name' => 'Harry',
            'surname' => 'Powell',
            'login' => 'powell',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'idTypeUser' => 1,
            'name' => 'Peter',
            'surname' => 'Franklin',
            'login' => 'franklin',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'idTypeUser' => 1,
            'name' => 'John',
            'surname' => 'Freeman',
            'login' => 'freeman',
            'password' => Hash::make('123456'),
        ]);

    }
}

class PatientSeeder extends Seeder{

    /**
     * Run the PatientSeeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users');
        User::create([
            'idTypeUser' => 2,
            'idDoctor' => 1,
            'name' => 'Alexander',
            'surname' => 'Fitzgerald',
            'login' => 'fitzgerald',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'idTypeUser' => 2,
            'idDoctor' => 1,
            'name' => 'Rudolf',
            'surname' => 'Roberts',
            'login' => 'roberts',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'idTypeUser' => 2,
            'idDoctor' => 1,
            'name' => 'David',
            'surname' => 'Simmons',
            'login' => 'simmons',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'idTypeUser' => 2,
            'idDoctor' => 1,
            'name' => 'Arron',
            'surname' => 'Bruce',
            'login' => 'bruce',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'idTypeUser' => 2,
            'idDoctor' => 2,
            'name' => 'Nickolas',
            'surname' => 'Cox',
            'login' => 'cox',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'idTypeUser' => 2,
            'idDoctor' => 1,
            'name' => 'Anthony',
            'surname' => 'Bryan',
            'login' => 'bryan',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'idTypeUser' => 2,
            'idDoctor' => 2,
            'name' => 'Pierce',
            'surname' => 'Bond',
            'login' => 'bond',
            'password' => Hash::make('123456'),
        ]);
    }
}

class VisitsSeeder extends Seeder{

    /**
     * Run the VisitsSeeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visits')->delete();
        DB::table('visits')->truncate();
        Visit::create([
            'idDoctor' => 1,
            'idPatient' => 6,
            'startVisit' => '2016-03-01 12:00:00',
            'endVisit' => '2016-03-01 13:00:00',
            'active' => true,
            'comment' => 'comment',
        ]);
        Visit::create([
            'idDoctor' => 1,
            'idPatient' => 7,
            'startVisit' => '2016-03-02 14:00:00',
            'endVisit' => '2016-03-02 15:00:00',
            'active' => true,
            'comment' => 'comment',
        ]);
        Visit::create([
            'idDoctor' => 2,
            'idPatient' => 8,
            'startVisit' => '2016-03-02 12:00:00',
            'endVisit' => '2016-03-02 13:00:00',
            'active' => true,
            'comment' => 'comment',
        ]);
        Visit::create([
            'idDoctor' => 2,
            'idPatient' => 9,
            'startVisit' => '2016-03-03 14:00:00',
            'endVisit' => '2016-03-03 15:00:00',
            'active' => true,
            'comment' => 'comment',
        ]);
    }
}



class PermissionSeeder extends Seeder{

    /**
     * Run the PermissionSeeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();
        DB::table('permissions')->truncate();
        Permission::create([
            'inFrom' => 2,
            'inTo' => 1
        ]);
        Permission::create([
            'inFrom' => 3,
            'inTo' => 1
        ]);
    }
}


