<?php

namespace Database\Factories\Warehouse;

use App\Models\Warehouse\GoodReceiptItemClassification;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoodReceiptItemClassificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GoodReceiptItemClassification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'good_receipt_item_id' => $this->faker->word,
        'product_id' => $this->faker->word,
        'weight' => $this->faker->numberBetween(0, 9223372036854775807)
        ];
    }
}
