<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        return [
            'title'       => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'theme_id'    => Theme::factory(),
            'date'        => $this->faker->date,
            'image'       => null,
        ];
    }
}
