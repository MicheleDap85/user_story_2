<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Pino',
            'email' => 'pino@example.com',
        ]);

        $categories = Category::query()->get();

        $articles = [
            ['Bici da corsa', 'Bici in ottimo stato, usata poco.', 150],
            ['iPhone 13', 'Telefono funzionante, batteria al 88%.', 320],
            ['Divano due posti', 'Tessuto grigio, nicchie di usura minime.', 180],
            ['Chitarra acustica', 'Suono pulito, corde nuove.', 90],
            ['Tavolo da giardino', 'Legno trattato, include 4 sedie.', 210],
            ['Scarpe running 42', 'Usate due volte, come nuove.', 45],
            ['Monitor 27 pollici', 'Full HD, HDMI e DisplayPort.', 110],
            ['Cuccia per cane', 'Taglia media, lavabile.', 35],
        ];

        foreach ($articles as $index => [$title, $description, $price]) {
            Article::create([
                'title' => $title,
                'description' => $description,
                'price' => $price,
                'category_id' => $categories[$index % $categories->count()]->id,
                'user_id' => $user->id,
                'created_at' => now()->subDays($index),
                'updated_at' => now()->subDays($index),
            ]);
        }
    }
}
