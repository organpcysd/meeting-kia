<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'report']);
        Permission::create(['name' => 'manageusers']);
        Permission::create(['name' => 'managecar']);
        Permission::create(['name' => 'managesystem']);

        $role_administrator = Role::create(['name' => 'ผู้บริหาร']);
        $role_administrator->syncPermissions(['report']);

        $role_manager = Role::create(['name' => 'ผู้จัดการ']);
        $role_manager->syncPermissions(['report','manageusers','managecar','managesystem']);

        $role_admin = Role::create(['name' => 'ผู้ดูแลระบบ']);
        $role_admin->syncPermissions(['report','manageusers','managecar','managesystem']);

        $role_sales = Role::create(['name' => 'ฝ่ายขาย']);
        $role_sales->syncPermissions([]);

        $user = \App\Models\User::create([
            'user_prefix_id' => '1',
            'f_name' => 'ศุภมิตร',
            'l_name' => 'จันทร์โทวงศ์',
            'status' => '1',
            'email' => 'supamit.ja@gmail.com',
            'password' => bcrypt('supamit2533'),
            'phone' => '0918821011',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $user2 = \App\Models\User::create([
            'user_prefix_id' => '1',
            'f_name' => 'สิทธิพล',
            'status' => '1',
            'email' => 'sittipol.do@gmail.com',
            'password' => bcrypt('sittipol1123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $user3 = \App\Models\User::create([
            'user_prefix_id' => '1',
            'f_name' => 'ธนัญศักดิ์',
            'l_name' => 'ปิ่นทอง',
            'status' => '1',
            'email' => 'thanansak@gmail.com',
            'password' => bcrypt('1212312121'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $user->assignRole($role_administrator);
        $user2->assignRole($role_admin);
        $user3->assignRole($role_admin);
    }
}
