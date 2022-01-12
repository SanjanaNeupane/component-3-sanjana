<?php

namespace Database\Factories;

use App\Models\Product;
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
        $type = array('cd', 'book', 'game');
        $key = array_rand($type);
        return [
            'firstName' => $this->faker->firstName(),
            'title' => $this->faker->sentence(),
            'mainName' => $this->faker->lastName(),
            'length' => rand(100, 1500),
            'price' => (float)rand(5, 500),
            'type' => $type[$key],
            'user_id' => rand(1, 6)
        ];
    }
}
