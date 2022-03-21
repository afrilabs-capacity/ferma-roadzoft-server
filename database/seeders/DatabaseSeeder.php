<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use Spatie\Permission\Models\Role;
use App\Models\AccessLog;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        // Role::create(['name'=>'Super Admin']);
        // Role::create(['name'=>'Admin']);
        // Role::create(['name'=>'Staff']);
        // Role::create(['name'=>'Ad-hoc']);
        //  Role::create(['name'=>'Citizen']);
        // Role::create(['name'=>'Supervisor']);

        // $user1 = \App\Models\User::create([
        //     'name'=>'Super Admin',
        //     'email'=>'superadmin@gmail.com',
        //     'phone'=>'07036066056',
        //     'dob'=>'1976',
        //     'state'=>'23',
        //     'lga'=>'468',
        //     'password'=>Hash::make('1234')

        // ]);

        // $role1 = Role::findByName("Super Admin");
        // $user1->assignRole($role1->id);


        // $user2 = \App\Models\User::create([
        //     'name'=>'John David',
        //     'email'=>'admin@gmail.com',
        //     'phone'=>'07036066077',
        //     'dob'=>'1976',
        //     'state'=>'23',
        //     'lga'=>'468',
        //     'password'=>Hash::make('1234')

        // ]);

        // $role2 = Role::findByName("Admin");
        // $user2->assignRole($role2->id);


        // $user3 = \App\Models\User::create([
        //     'name'=>'David Thompson',
        //     'email'=>'staff@gmail.com',
        //     'phone'=>'07036066088',
        //     'dob'=>'1976',
        //     'state'=>'23',
        //     'lga'=>'468',
        //     'password'=>Hash::make('1234')

        // ]);

        // $role3 = Role::findByName("Staff");
        // $user3->assignRole($role3->id);

        // $user4 = \App\Models\User::create([
        //     'name'=>'Tailor Ottwell',
        //     'email'=>'ad-hoc@gmail.com',
        //     'phone'=>'07036066099',
        //     'dob'=>'1976',
        //     'state'=>'23',
        //     'lga'=>'468',
        //     'password'=>Hash::make('1234')

        // ]);

        // $role4 = Role::findByName("Ad-hoc");
        // $user4->assignRole($role4->id);

        //  $user5 = \App\Models\User::create([
        //     'name'=>'Dan Sulevan',
        //     'email'=>'ad-hoc2@gmail.com',
        //     'phone'=>'07036066022',
        //     'dob'=>'1976',
        //     'state'=>'23',
        //     'lga'=>'468',
        //     'password'=>Hash::make('1234')

        // ]);

        // $role5 = Role::findByName("Ad-hoc");
        // $user5->assignRole($role5->id);


        // AccessLog::create(['name'=>'User Logs','description'=>'All user logs']);

        // AccessLog::create(['name'=>'Project Logs','description'=>'All project logs']);

        // AccessLog::create(['name'=>'Report Logs','description'=>'All report logs']);

        //  AccessLog::create(['name'=>'Role Logs','description'=>'All role logs']);

        //  AccessLog::create(['name'=>'Role Assignment Logs','description'=>'All role assignment logs']);

        //  AccessLog::create(['name'=>'Project Assignment Logs','description'=>'All project assignment logs']);
    }
}
