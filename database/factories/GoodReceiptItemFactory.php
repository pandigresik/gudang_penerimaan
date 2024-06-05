<?php

namespace Database\Factories\Warehouse;

use App\Models\Warehouse\GoodReceiptItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoodReceiptItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GoodReceiptItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'good_receipt_id' => $this->faker->word,
        'product_id' => $this->faker->word
        ];
    }
}
