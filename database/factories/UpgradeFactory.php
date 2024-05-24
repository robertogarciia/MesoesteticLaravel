<?php 
namespace Database\Factories;

use App\Models\Upgrade;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class UpgradeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Upgrade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
{
    $user = \App\Models\User::factory()->create(); // Crear un usuario
     // Crear un administrador
    
    return [
        'title' => $this->faker->sentence,
        'zone' => $this->faker->randomElement(['Cosmeticos','Medicamentos','Sanitaria','Control de calidad']),
        'type' => $this->faker->randomElement(['Maquinaria', 'Espacio', 'Material']),
        'worry' => $this->faker->sentence,
        'benefit' => $this->faker->sentence,
        'state' => $this->faker->randomElement(['Valorandose','En curso','Resuelta']),
        'likes' => 0,
        'user_id' => $user->id,


    ];
}


}
