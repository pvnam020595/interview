<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name' => Str::random(5),
            'price' => rand(1, 10000000),
            'code' => Str::random(5),
            // 'store_id' => function () {
            //     return factory(Store::class)->create()->id;
            // },
            'store_id' => ''
        ];
    }
}
