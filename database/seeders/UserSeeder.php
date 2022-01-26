<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => config('app.admin.name'),
            'email' => config('app.admin.email'),
            'password' => bcrypt(config('app.admin.password'))
        ]);
    }
}
