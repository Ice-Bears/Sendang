<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'Admin Admin',
        //     'email' => 'admin@argon.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('secret'),
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        $role = Role::findOrCreate('superadmin');

        $user = new User();
        $user->name = 'Supreme Admin';
        $user->email = 'superadmin@sendangkuwanen.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('secret');
        $user->save();

        $user->assignRole($role);
    }
}
