<?php

namespace Database\Factories\Warehouse;

use App\Models\Warehouse\GoodReceiptItemWeight;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoodReceiptItemWeightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GoodReceiptItemWeight::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'good_receipt_item_id' => $this->faker->word,
        'quantity' => $this->faker->word,
        'weight' => $this->faker->numberBetween(0, 9223372036854775807),
        'is_sampling' => $this->faker->boolean,
        'state' => $this->faker->text($this->faker->numberBetween(5, 4096))
        ];
    }
}
