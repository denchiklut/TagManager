<?php

use Illuminate\Database\Seeder;
use App\Models\Analitics;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(Analitics::class, 50)->create();
    }
}