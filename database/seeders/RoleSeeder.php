<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use DB;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $toTruncate = ['model_has_permissions','model_has_roles','role_has_permissions','permissions','roles'];

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        $data = array(
            [
                'name'       => 'Admin',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Sub Admin',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Nutritionist',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Customer',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        );

        Role::insert($data);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
