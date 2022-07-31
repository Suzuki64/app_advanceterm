<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'admin' => 'admin',
            '山田太郎' => 'yamadataro',
        ];

        foreach($names as $name => $email)

            User::create([
                'name' =>  $name,
                'email' => $email.'@aaa.com',
                'password' => bcrypt('abc12345'),
                'role_id' => '1'
            ]);

    }
}
