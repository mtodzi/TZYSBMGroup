<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(10),
            'code' => $this->faker->currencyCode,
            'shipment_id'=> Shipment::factory() 
        ];
    }
}
