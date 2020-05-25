<?php

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
        DB::table('users')->insert([
            'name' => 'Haresh Sisodiya',
            'email' => 'haresh.sisodiya@viitor.cloud',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Dhaval Joshi',
            'email' => 'dhaval.joshi@viitor.cloud',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Devat Karetha',
            'email' => 'devat.karetha@viitor.cloud',
            'password' => bcrypt('123456'),
        ]);
    }
}
