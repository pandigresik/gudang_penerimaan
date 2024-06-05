<?php

namespace Database\Factories\Warehouse;

use App\Models\Warehouse\GoodReceipt;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoodReceiptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GoodReceipt::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'partner_id' => $this->faker->word,
        'receipt_date' => $this->faker->date('Y-m-d'),
        'state' => $this->faker->text($this->faker->numberBetween(5, 4096)),
        'description' => $this->faker->text($this->faker->numberBetween(5, 255))
        ];
    }
}
