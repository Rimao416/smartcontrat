<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Theme;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateArticleRequestTest extends TestCase
{
    use RefreshDatabase;

    protected $theme;
    protected $article;

    protected function setUp(): void
    {
        parent::setUp();
        // Créer un thème pour le test
        $this->theme = Theme::factory()->create();
        // Créer un article pour le test
        $this->article = Article::factory()->create([
            'theme_id' => $this->theme->id,
        ]);
    }

    /** @test */
    public function it_requires_a_valid_title_when_provided()
    {
        $response = $this->put(route('articles.update', $this->article), [
            'title' => '', // Titre vide
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function it_requires_a_valid_description_when_provided()
    {
        $response = $this->put(route('articles.update', $this->article), [
            'description' => '', // Description vide
        ]);

        $response->assertSessionHasErrors('description');
    }

    /** @test */
    public function it_requires_a_valid_image_format()
    {
        $response = $this->put(route('articles.update', $this->article), [
            'image' => 'invalid-image', // Ce n'est pas une image
        ]);

        $response->assertSessionHasErrors('image');
    }

    /** @test */
    public function it_requires_a_valid_existing_theme_when_provided()
    {
        $response = $this->put(route('articles.update', $this->article), [
            'theme_id' => 99999, // Un ID inexistant
        ]);

        $response->assertSessionHasErrors('theme_id');
    }

    /** @test */
    public function it_requires_a_valid_date_format_when_provided()
    {
        $response = $this->put(route('articles.update', $this->article), [
            'date' => 'invalid-date', // Mauvais format
        ]);

        $response->assertSessionHasErrors('date');
    }

    /** @test */
    public function it_updates_the_article_successfully_with_valid_data()
    {
        $validData = [
            'title'       => 'Titre mis à jour',
            'description' => 'Nouvelle description',
            'theme_id'    => $this->theme->id,
            'date'        => '2025-02-25',
        ];

        $response = $this->put(route('articles.update', $this->article), $validData);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('articles', [
            'id'          => $this->article->id,
            'title'       => 'Titre mis à jour',
            'description' => 'Nouvelle description',
            'theme_id'    => $this->theme->id,
            'date'        => '2025-02-25',
        ]);
    }
}
