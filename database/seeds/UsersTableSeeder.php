<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $adminRole=Role::where('name','admin')->first();
        $doctorRole=Role::where('name','doctor')->first();
        $nurseRole=Role::where('name','nurse')->first();
        $receptionistRole=Role::where('name','receptionist')->first();

        $admin=User::create([
          'name' => 'admin',
          'email' => 'admin@admin.com',
          'password'=>bcrypt( 'admin'),
          'phoneNumber'=>'phoneNumber'
        ]);

        $doctor=User::create([
          'name' => 'doctor',
          'email' => 'doctor@doctor.com',
          'password'=>bcrypt( 'doctor'),
          'phoneNumber'=>'phoneNumber'
        ]);

        $nurse=User::create([
          'name' => 'nurse',
          'email' => 'nurse@nurse.com',
          'password'=>bcrypt( 'nurse'),
          'phoneNumber'=>'phoneNumber'
        ]);

        $receptionist=User::create([
          'name' => 'receptionist',
          'email' => 'receptionist@receptionist.com',
          'password'=>bcrypt( 'receptionist'),
          'phoneNumber'=>'phoneNumber'
        ]);
        $admin->roles()->attach($adminRole);
        $doctor->roles()->attach($doctorRole);
        $nurse->roles()->attach($nurseRole);
        $receptionist->roles()->attach($receptionistRole);
    }
}
