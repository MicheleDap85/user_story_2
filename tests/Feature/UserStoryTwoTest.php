<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserStoryTwoTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_shows_the_latest_six_articles(): void
    {
        $this->seed();

        $user = User::factory()->create();
        $category = Category::query()->firstOrFail();

        $latest = Article::factory()->create([
            'title' => 'Annuncio più recente',
            'price' => 99.50,
            'user_id' => $user->id,
            'category_id' => $category->id,
            'created_at' => now(),
        ]);

        Article::factory()->count(6)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'created_at' => now()->subDays(10),
        ]);

        $this->get(route('homepage'))
            ->assertOk()
            ->assertSee('Ultimi annunci')
            ->assertSee($latest->title)
            ->assertSee('99,50')
            ->assertSee($category->name);
    }

    public function test_index_lists_articles_from_newest_to_oldest(): void
    {
        $this->seed();

        $response = $this->get(route('article.index'));

        $response->assertOk()
            ->assertSee('Tutti gli annunci')
            ->assertSee('Bici da corsa')
            ->assertSee('iPhone 13');
    }

    public function test_article_detail_shows_placeholder_carousel(): void
    {
        $this->seed();

        $article = Article::query()->firstOrFail();

        $this->get(route('article.show', $article))
            ->assertOk()
            ->assertSee($article->title)
            ->assertSee($article->description)
            ->assertSee($article->category->name)
            ->assertSee('articleCarousel')
            ->assertSee('Foto segnaposto');
    }

    public function test_category_page_lists_only_articles_from_that_category(): void
    {
        $this->seed();

        $user = User::factory()->create();
        $sport = Category::query()->where('name', 'Sport')->firstOrFail();
        $motori = Category::query()->where('name', 'Motori')->firstOrFail();

        $sportArticle = Article::factory()->create([
            'title' => 'Racchetta da tennis',
            'user_id' => $user->id,
            'category_id' => $sport->id,
        ]);

        $otherArticle = Article::factory()->create([
            'title' => 'Scooter 50cc',
            'user_id' => $user->id,
            'category_id' => $motori->id,
        ]);

        $this->get(route('article.byCategory', $sport))
            ->assertOk()
            ->assertSee('Annunci in Sport')
            ->assertSee($sportArticle->title)
            ->assertDontSee($otherArticle->title);
    }
}
