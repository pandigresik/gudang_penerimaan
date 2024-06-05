<?php

namespace Database\Factories\Base;

use App\Models\Base\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

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
        'product_category_id' => $this->faker->word,
        'image' => $this->faker->text($this->faker->numberBetween(5, 255))
        ];
    }
}
