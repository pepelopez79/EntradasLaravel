<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Entrada;
use App\Models\Categoria;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->count(4)->create();

        Entrada::factory()->count(10)->create();

        Categoria::factory()->count(5)->create();
    }
}

