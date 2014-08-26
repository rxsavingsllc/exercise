<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
            'secret_key' => Hash::make('s3cret!'),
            'first_name' => 'Roger',
            'last_name'  => 'Rogerson'
        ));

        User::create(array(
            'secret_key' => Hash::make('an0th3r_s3cret!'),
            'first_name' => 'Will',
            'last_name'  => 'Super'
        ));

        User::create(array(
            'secret_key' => Hash::make('W0w,an0th3r_s3cret!'),
            'first_name' => 'First',
            'last_name'  => 'Last'
        ));
    }

}