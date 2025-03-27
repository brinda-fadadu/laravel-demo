<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Spatie\Permission\Models\Permission;
use App\Models\Role;

class AssignNutritionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionData = [
            [
                'code' => 'Add',
                'name' => 'ASSIGN_NUTRITION_ADD',
                'guard_name' => 'web',
                'module' => 'Assign Nutrition',
            ],
            [
                'code' => 'View',
                'name' => 'ASSIGN_NUTRITION_VIEW',
                'guard_name' => 'web',
                'module' => 'Assign Nutrition',
            ],
            [
                'code' => 'View',
                'name' => 'PAYMENT_HISTORY_VIEW',
                'guard_name' => 'web',
                'module' => 'Payment History',
            ]
        ];  
        foreach ($permissionData as $permission) {
            Permission::create($permission);
        }
        
        $role = Role::where('name', 'Admin')->first();

        $modules = ['Assign Nutrition', 'Payment History'];

        $permissions = Permission::whereIn('module', $modules)->get();
        $role->givePermissionTo($permissions);
    }
}
