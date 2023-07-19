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

        //Users
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
        DB::table('users')->insert([
            'name' => "landlord",
            'email' => 'landlord@landlord.com',
            'password' => Hash::make('landlord'),
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ]);

        //Roles
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
        DB::table('roles')->insert([
            //Орендодавець
            'name' => "landlord",
            'guard_name' => 'web',
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ]);

        //Model-Role
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
        DB::table ('model_has_roles')->insert([
            'role_id'=>'3',
            'model_type'=>'App\Models\User',
            'model_id'=>'3',
        ]);
        
        //Permission
        DB::table('permissions')->insert([
            'name' => "role administrate",
            'guard_name' => 'web',
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),

        ]);
        DB::table('permissions')->insert([
            'name' => "Full access",
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
        DB::table('permissions')->insert([
            'name' => "status administrate",
            'guard_name' => 'web',
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ]);
        DB::table('permissions')->insert([
            'name' => "placement administrate",
            'guard_name' => 'web',
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ]);

        //Role-Permission
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
        DB::table('role_has_permissions')->insert([
            'permission_id' => "4",
            'role_id' => '1',
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => "5",
            'role_id' => '1',
        ]);
       
        DB::table('role_has_permissions')->insert([
            'permission_id' => "5",
            'role_id' => '3',
        ]);
        //Categories
        DB::table('comfort_categories')->insert([
            'title'=>"Comfort",
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ]);
        DB::table('comfort_categories')->insert([
            'title'=>"Kitchen",
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ]);
        DB::table('comfort_categories')->insert([
            'title'=>"Bathroom",
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ]);
        DB::table('comfort_categories')->insert([
            'title'=>"Other",
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ]);
        //Comforts
        DB::table('comforts')->insert([
            'title'=>"WI-Fi",
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
            'categoryId'=>1,
        ]);
        DB::table('comforts')->insert([
            'title'=>"Refrigirator",
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
            'categoryId'=>2,
        ]);
        DB::table('comforts')->insert([
            'title'=>"Microwave",
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
            'categoryId'=>2,
        ]);
        DB::table('comforts')->insert([
            'title'=>"WC",
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
            'categoryId'=>3,
        ]);
        DB::table('comforts')->insert([
            'title'=>"Shower",
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
            'categoryId'=>3,
        ]);
        DB::table('comforts')->insert([
            'title'=>"BBQ",
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
            'categoryId'=>4,
        ]);
        DB::table('comforts')->insert([
            'title'=>"Air condition",
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
            'categoryId'=>4,
        ]);
    }
}
