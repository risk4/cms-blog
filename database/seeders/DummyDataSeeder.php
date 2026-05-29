<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin User if not exists
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        );

        // 2. Create Categories
        $categories = [
            ['name' => 'Technology', 'slug' => 'technology', 'icon' => 'cpu', 'order' => 1],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'icon' => 'heart', 'order' => 2],
            ['name' => 'Business', 'slug' => 'business', 'icon' => 'briefcase', 'order' => 3],
            ['name' => 'Travel', 'slug' => 'travel', 'icon' => 'map', 'order' => 4],
            ['name' => 'Education', 'slug' => 'education', 'icon' => 'book', 'order' => 5],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 3. Create Tags
        $tags = ['Laravel', 'PHP', 'Tailwind', 'VueJS', 'React', 'Tips', 'Tutorial', 'News'];
        foreach ($tags as $tagName) {
            Tag::firstOrCreate(['name' => $tagName], ['slug' => Str::slug($tagName)]);
        }

        // 4. Create Posts
        $allCategories = Category::all();
        $allTags = Tag::all();

        for ($i = 1; $i <= 20; $i++) {
            $title = "Artikel Dummy Ke-$i: " . fake()->sentence(6);
            $post = Post::create([
                'user_id' => $user->id,
                'category_id' => $allCategories->random()->id,
                'title' => $title,
                'slug' => Str::slug($title) . '-' . uniqid(),
                'content' => fake()->paragraphs(8, true),
                'excerpt' => fake()->sentence(20),
                'status' => 'published',
                'is_featured' => $i <= 3, // 3 featured posts
                'views' => rand(100, 5000),
                'published_at' => now()->subDays(rand(0, 30)),
            ]);

            // Attach random tags
            $post->tags()->attach($allTags->random(rand(2, 4))->pluck('id'));
        }

        // 5. Create Pages
        $pages = ['About Us', 'Contact', 'Privacy Policy', 'Terms of Service'];
        foreach ($pages as $pageTitle) {
            Page::updateOrCreate(
                ['slug' => Str::slug($pageTitle)],
                [
                    'user_id' => $user->id,
                    'title' => $pageTitle,
                    'content' => fake()->paragraphs(5, true),
                    'status' => 'published',
                ]
            );
        }
    }
}