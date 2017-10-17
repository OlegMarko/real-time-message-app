<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\PrivateMessage::truncate();

        factory(\App\PrivateMessage::class, 100)->create();
    }
}
