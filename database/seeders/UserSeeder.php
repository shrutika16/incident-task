<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name =  'Boppo Technologies';
        $user->email = 'shrutika@boppotech.com';
        $plainPassword = 'boppo@123';
        $user->password = app('hash')->make($plainPassword);

        $user->save();
        // $this->call('UsersTableSeeder');
    }
}
