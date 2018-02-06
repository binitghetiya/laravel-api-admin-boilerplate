<?php

use Illuminate\Database\Seeder;

class ApplicationTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('application')->insert([
            'app_name' => 'Laravel api with admin panel boiler plate',
            'client_id' => 'e340e7d3ce77625c',
            'secret_key' => '122ef9d1b56d816d1d57f8b98b22cbe6',
            'web_url' => 'http://localhost:8000',
            'status' => 1
        ]);
    }

}
