<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Setting::create([
            'site_name' => "Laravel's Blog",
            'contact_number'   => '9746408151',
            'contact_email'     => 'vivekmalumel@gmail.com',
            'address'       => 'No26, Doctors colony,TVM'
        ]);
    }
}
