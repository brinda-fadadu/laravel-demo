<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use DB;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        $admin = User::create(
          [
            'uuid' => Str::uuid()->toString(),
            'name' => 'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt("admin@123"),
            'role_id' => 1
          ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $admin->roles()->sync(1);

    }
}
