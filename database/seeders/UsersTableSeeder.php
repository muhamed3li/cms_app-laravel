<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('email','mohamed@gmail.com')->first();

        if(!$user){
          User::create([
            'name'=>'mohamed',
            'email'=>'mohamed@gmail.com',
            'password'=>Hash::make('123456'),
            'role'=>'admin',
          ]);
        }
    }
}
