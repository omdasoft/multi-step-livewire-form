<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'email' => 'admin@admin.com',
            'name' => 'admin',
            'nationality_id' => 114,
            'national_number' =>'98610425878',
            'service_type' =>'1',
            'residency' =>111,
            'country_name' =>'jordan',
            'ip' =>'122.25.258',
            'password' => bcrypt('123456'),
        ]);

        $doctor = User::create([
            'email' => 'doctor@user.com',
            'name' => 'doctor',
            'nationality_id' => 114,
            'national_number' =>'98610425876',
            'service_type' =>'1',
            'residency' =>111,
            'country_name' =>'jordan',
            'ip' =>'122.25.258',
            'password' => bcrypt('123456'),
        ]);

        $adminRole = Role::where('name', 'Admin')->first();
        $admin->assignRole($adminRole);
        $doctorRole = Role::where('name', 'Doctor')->first();
        $doctor->assignRole($doctorRole);
    }
}
