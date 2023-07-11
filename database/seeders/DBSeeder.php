<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DateTime;

class DBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "admin",
            'email' => 'admin@admin.com',
            'password' => Hash::make('adminadmin'), 
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ]);
        DB::table('users')->insert([
            'name' => "user",
            'email' => 'user@user.com',
            'password' => Hash::make('useruser'),
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ]);

        DB::table('roles')->insert([
            'name' => "admin",
            'guard_name' => 'web',
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ]);
        DB::table('roles')->insert([
            'name' => "user",
            'guard_name' => 'web',
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ]);
        DB::table ('model_has_roles')->insert([
            'role_id'=>'1',
            'model_type'=>'App\Models\User',
            'model_id'=>'1',
        ]);
        DB::table ('model_has_roles')->insert([
            'role_id'=>'2',
            'model_type'=>'App\Models\User',
            'model_id'=>'2',
        ]);
            
        DB::table('permissions')->insert([
            'name' => "role administrate",
            'guard_name' => 'web',
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),

        ]);
        DB::table('permissions')->insert([
            'name' => "user administrate",
            'guard_name' => 'web',
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ]);
        DB::table('permissions')->insert([
            'name' => "permission administrate",
            'guard_name' => 'web',
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ]);

        
        DB::table('role_has_permissions')->insert([
            'permission_id' => "1",
            'role_id' => '1',
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => "2",
            'role_id' => '1',
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => "3",
            'role_id' => '1',
        ]);

    }
}
