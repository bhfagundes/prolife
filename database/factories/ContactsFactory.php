<?php

namespace Database\Factories;

use App\Models\Contacts;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contacts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'email' => $this->faker->word,
        'phone' => $this->faker->word,
        'message' => $this->faker->text,
        'file' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
