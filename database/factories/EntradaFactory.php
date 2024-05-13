<?php

namespace Database\Factories;

use App\Models\Entrada;
use App\Models\User;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntradaFactory extends Factory
{
    protected $model = Entrada::class;

    public function definition()
    {
        return [
            'usuario_id' => User::factory(),
            'categoria_id' => Categoria::factory(),
            'titulo' => $this->faker->sentence,
            'contenido' => $this->faker->paragraph,
        ];
    }
}
