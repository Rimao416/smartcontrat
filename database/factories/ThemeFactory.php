<?php

namespace Database\Factories;

use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Theme>
 */
class ThemeFactory extends Factory
{
    protected $model = Theme::class;

    public function definition()
    {
        $label = $this->faker->word;
        return [
            'label' => ucfirst($label),
            'slug'  => Str::slug($label) . '-' . $this->faker->unique()->numberBetween(1, 1000),
        ];
    }
}
