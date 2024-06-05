<?php

namespace Database\Factories\Base;

use App\Models\Base\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Partner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->text($this->faker->numberBetween(5, 10)),
        'name' => $this->faker->text($this->faker->numberBetween(5, 50)),
        'description' => $this->faker->boolean,
        'active' => $this->faker->boolean,
        'address' => $this->faker->text($this->faker->numberBetween(5, 255)),
        'city' => $this->faker->text($this->faker->numberBetween(5, 255)),
        'email' => $this->faker->email,
        'phone' => $this->faker->numerify('0##########'),
        'mobile' => $this->faker->text($this->faker->numberBetween(5, 255)),
        'additional_info' => $this->faker->text($this->faker->numberBetween(5, 255))
        ];
    }
}
