<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interest>
 */
class InterestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'Машины',
            'Спорт',
            'Программирование',
            'Кино',
            'Искусство',
            'Гейминг',
            'Пейнтбол',
            'Танки онлайн',
            'Пить пиво',
            'Ауди',
            'Мотоциклы',
            'Гонки',
            'Девушки',
            'Спать',
            'Гири',
        ];
        return [
            'name' => $this->faker->randomElement($names),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
