<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Theme;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class StoreArticleRequestTest extends TestCase
{
    use RefreshDatabase;

    protected $theme;

    protected function setUp(): void
    {
        parent::setUp();
        // Crée un thème pour les tests
        $this->theme = Theme::factory()->create();
    }

    /** @test */
    public function it_requires_a_title()
    {
        $response = $this->post(route('articles.store'), [
            'title'       => '',
            'description' => 'Une description valide',
            'theme_id'    => $this->theme->id,
            'date'        => '2025-02-25',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function it_requires_a_valid_title_string_and_max_length()
    {
        $response = $this->post(route('articles.store'), [
            'title'       => str_repeat('a', 300), // trop long
            'description' => 'Une description valide',
            'theme_id'    => $this->theme->id,
            'date'        => '2025-02-25',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function it_requires_a_description()
    {
        $response = $this->post(route('articles.store'), [
            'title'       => 'Un titre valide',
            'description' => '',
            'theme_id'    => $this->theme->id,
            'date'        => '2025-02-25',
        ]);

        $response->assertSessionHasErrors('description');
    }

    /** @test */
    public function it_requires_a_valid_image_if_provided()
    {
        // Fournir une chaîne au lieu d'un fichier image
        $response = $this->post(route('articles.store'), [
            'title'       => 'Titre valide',
            'description' => 'Description valide',
            'theme_id'    => $this->theme->id,
            'date'        => '2025-02-25',
            'image'       => 'not-an-image',
        ]);

        $response->assertSessionHasErrors('image');
    }

    /** @test */
    public function it_requires_a_valid_existing_theme()
    {
        $response = $this->post(route('articles.store'), [
            'title'       => 'Titre valide',
            'description' => 'Description valide',
            'theme_id'    => 99999, // ID inexistant
            'date'        => '2025-02-25',
        ]);

        $response->assertSessionHasErrors('theme_id');
    }

    /** @test */
    public function it_requires_a_valid_date()
    {
        $response = $this->post(route('articles.store'), [
            'title'       => 'Titre valide',
            'description' => 'Description valide',
            'theme_id'    => $this->theme->id,
            'date'        => 'not-a-date',
        ]);

        $response->assertSessionHasErrors('date');
    }

    /** @test */
    public function it_stores_the_article_successfully_with_valid_data()
    {
        $validData = [
            'title'       => 'Titre valide',
            'description' => 'Description valide',
            'theme_id'    => $this->theme->id,
            'date'        => '2025-02-25',
            'image' => UploadedFile::fake()->create('article.jpg', 100, 'image/jpeg'),
        ];

        $response = $this->post(route('articles.store'), $validData);

        // On s'attend à être redirigé vers l'index avec un message de succès
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('articles.index'));

        // Vérifier que l'article a bien été créé dans la base de données.
        $this->assertDatabaseHas('articles', [
            'title'       => 'Titre valide',
            'description' => 'Description valide',
            'theme_id'    => $this->theme->id,
            'date'        => '2025-02-25',
        ]);
    }
}
