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
        Permission::create(['name' => 'manageuser']);
        Permission::create(['name' => 'managewebsite']);
        Permission::create(['name' => 'managesomething']);

        $role_administrator = Role::create(['name' => 'ผู้บริหาร']);
        $role_administrator->syncPermissions(['managewebsite','manageuser']);

        $role_manager = Role::create(['name' => 'ผู้จัดการ']);
        $role_manager->syncPermissions(['managewebsite','manageuser']);

        $role_admin = Role::create(['name' => 'ผู้ดูแลระบบ']);
        $role_admin->syncPermissions(['managewebsite','manageuser']);

        $role_sales = Role::create(['name' => 'ฝ่ายขาย']);
        $role_sales->syncPermissions(['managesomething']);

        $user = \App\Models\User::create([
            'user_prefix_id' => '3',
            'f_name' => 'พิชญสุดา',
            'l_name' => 'ชุลีวรรณ์',
            'nickname' => 'ออร์แกน',
            'status' => '1',
            'email' => 'b6121877@g.sut.ac.th',
            'password' => bcrypt('password'),
            'phone' => '0981495240',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $user->assignRole($role_administrator);
    }
}
