<?php

declare(strict_types=1);

namespace Cortex\Categories\Database\Factories;

use Cortex\Categories\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => [$this->faker->languageCode => $this->faker->title],
            'slug' => $this->faker->slug
        ];
    }
}
