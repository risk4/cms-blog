<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Reuse an existing user if available, otherwise create a safe admin record
        // that matches the existing database schema.
        $admin = User::first();

        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]);
        }

        // Create categories
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Technology related articles',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Business and entrepreneurship',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => 'Lifestyle and wellness',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'description' => 'Travel guides and tips',
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }

        // Create tags
        $tags = ['Laravel', 'PHP', 'JavaScript', 'Web Development', 'Tutorial', 'News', 'Guide'];
        foreach ($tags as $tagName) {
            Tag::firstOrCreate([
                'slug' => Str::slug($tagName),
            ], [
                'name' => $tagName,
            ]);
        }

        // Create sample posts
        $posts = [
            [
                'title' => 'Getting Started with Laravel 12',
                'slug' => 'getting-started-with-laravel-12',
                'excerpt' => 'Learn the basics of Laravel 12 and start building modern web applications.',
                'content' => '<p>Laravel 12 brings exciting new features and improvements to the framework. In this comprehensive guide, we\'ll explore the key features and how to get started with your first Laravel 12 project.</p><p>Laravel continues to be one of the most popular PHP frameworks, and version 12 introduces several enhancements that make development even more enjoyable.</p>',
                'category_id' => 1,
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now(),
                'is_featured' => true,
                'is_slider' => true,
                'views' => 150,
            ],
            [
                'title' => 'Building a Modern CMS with Laravel',
                'slug' => 'building-modern-cms-laravel',
                'excerpt' => 'A step-by-step guide to creating a content management system using Laravel.',
                'content' => '<p>Content Management Systems are essential for managing website content efficiently. In this tutorial, we\'ll build a complete CMS using Laravel 12.</p><p>We\'ll cover everything from database design to creating a user-friendly admin interface.</p>',
                'category_id' => 1,
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now()->subDays(1),
                'is_featured' => true,
                'is_slider' => true,
                'views' => 89,
            ],
            [
                'title' => 'Top Business Strategies for 2026',
                'slug' => 'top-business-strategies-2026',
                'excerpt' => 'Discover the most effective business strategies to implement this year.',
                'content' => '<p>As we navigate through 2026, businesses need to adapt to changing market conditions and consumer behaviors. Here are the top strategies that successful companies are implementing.</p>',
                'category_id' => 2,
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'is_slider' => true,
                'views' => 67,
            ],
            [
                'title' => 'Healthy Living Tips for Busy Professionals',
                'slug' => 'healthy-living-tips-busy-professionals',
                'excerpt' => 'Maintain a healthy lifestyle even with a busy schedule.',
                'content' => '<p>Balancing work and health can be challenging. These practical tips will help you maintain wellness while managing a demanding career.</p>',
                'category_id' => 3,
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'views' => 45,
            ],
            [
                'title' => 'Best Travel Destinations in Southeast Asia',
                'slug' => 'best-travel-destinations-southeast-asia',
                'excerpt' => 'Explore the most beautiful places in Southeast Asia.',
                'content' => '<p>Southeast Asia offers incredible diversity in culture, cuisine, and landscapes. Here are the must-visit destinations for your next adventure.</p>',
                'category_id' => 4,
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now()->subDays(4),
                'views' => 123,
            ],
        ];

        foreach ($posts as $postData) {
            $post = Post::firstOrCreate(['slug' => $postData['slug']], $postData);

            // Attach random tags to posts if none are attached yet
            if ($post->tags()->count() === 0) {
                $post->tags()->attach(Tag::inRandomOrder()->limit(rand(2, 4))->pluck('id'));
            }
        }

        // Create sample pages
        $pages = [
            [
                'title' => 'About',
                'slug' => 'about',
                'content' => '<h1>About Us</h1><p>Welcome to our blog. We are dedicated to providing quality content and insights on various topics including technology, business, lifestyle, and travel.</p><p>Our team of experienced writers and contributors work hard to bring you the latest news, trends, and in-depth analysis.</p>',
                'template' => 'default',
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now(),
                'order' => 1,
                'show_in_menu' => true,
            ],
            [
                'title' => 'Contact',
                'slug' => 'contact',
                'content' => '<h1>Contact Us</h1><p>Get in touch with us for any inquiries or feedback.</p>',
                'template' => 'default',
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now(),
                'order' => 2,
                'show_in_menu' => true,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<h1>Privacy Policy</h1><p>Your privacy is important to us. This policy outlines how we handle your data.</p>',
                'template' => 'default',
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now(),
                'order' => 3,
                'show_in_menu' => false,
            ],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(['slug' => $page['slug']], $page);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin credentials:');
        $this->command->info('Email: admin@example.com');
        $this->command->info('Password: password');
    }
}