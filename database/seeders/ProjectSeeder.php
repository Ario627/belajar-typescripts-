<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * ProjectSeeder
 * 
 * Seeder ini membuat data sample untuk testing aplikasi portfolio.
 * Akan membuat 1 admin user dan beberapa sample projects.
 */
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Method ini akan dipanggil saat menjalankan: php artisan db:seed
     */
    public function run(): void
    {
        // Buat user admin untuk testing
        // firstOrCreate akan cek dulu apakah user dengan email ini sudah ada
        // Jika belum ada, baru dibuat
        $admin = User::firstOrCreate(
            ['email' => 'admin@portfolio.com'],
            [
                'name' => 'Admin Portfolio',
                'password' => Hash::make('password'), // Password: password
            ]
        );

        // Array sample projects untuk portfolio
        $projects = [
            [
                'title' => 'E-Commerce Website with Laravel',
                'description' => 'Full-featured e-commerce platform dengan Laravel, Vue.js, dan Stripe payment integration. Mencakup product management, shopping cart, checkout process, dan admin dashboard.',
                'content' => 'Project e-commerce yang dibangun menggunakan Laravel 11 sebagai backend, Vue.js untuk frontend interaktif, dan Tailwind CSS untuk styling. Fitur utama meliputi: katalog produk dengan filter dan search, shopping cart dengan local storage, checkout process dengan Stripe integration, order management, dan admin dashboard untuk mengelola products, orders, dan customers.',
                'image' => 'https://via.placeholder.com/800x600/3498db/ffffff?text=E-Commerce',
                'url' => 'https://example-ecommerce.com',
                'repository' => 'https://github.com/example/ecommerce',
                'technologies' => ['Laravel', 'Vue.js', 'Tailwind CSS', 'MySQL', 'Stripe'],
                'status' => 'published',
                'started_at' => '2024-01-15',
                'completed_at' => '2024-06-30',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'Task Management App',
                'description' => 'Aplikasi manajemen tugas dengan fitur team collaboration, real-time updates menggunakan Laravel WebSockets, dan Kanban board interface.',
                'content' => 'Task management app yang memungkinkan teams untuk berkolaborasi dalam mengelola project. Fitur meliputi: kanban board dengan drag & drop, real-time collaboration menggunakan Laravel WebSockets, task assignment dan deadline tracking, team management, dan notification system.',
                'image' => 'https://via.placeholder.com/800x600/e74c3c/ffffff?text=Task+Manager',
                'url' => 'https://example-taskmanager.com',
                'repository' => 'https://github.com/example/taskmanager',
                'technologies' => ['Laravel', 'Livewire', 'Alpine.js', 'PostgreSQL', 'WebSockets'],
                'status' => 'published',
                'started_at' => '2024-03-01',
                'completed_at' => '2024-08-15',
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'Blog Platform with CMS',
                'description' => 'Platform blog dengan custom CMS untuk writers. Mendukung multiple authors, categories, tags, SEO optimization, dan markdown editor.',
                'content' => 'Blog platform dengan CMS yang user-friendly. Writers dapat dengan mudah membuat dan manage posts dengan markdown editor. Fitur meliputi: multi-author support, category dan tag management, SEO meta tags, image optimization, comment system, dan analytics dashboard.',
                'image' => 'https://via.placeholder.com/800x600/2ecc71/ffffff?text=Blog+CMS',
                'url' => null, // Belum live
                'repository' => 'https://github.com/example/blog-cms',
                'technologies' => ['Laravel', 'FilamentPHP', 'MySQL', 'Redis', 'Meilisearch'],
                'status' => 'published',
                'started_at' => '2024-05-10',
                'completed_at' => null, // Still in development
                'is_featured' => false,
                'order' => 3,
            ],
            [
                'title' => 'Restaurant Reservation System',
                'description' => 'Sistem reservasi online untuk restaurant dengan real-time table availability, automated email confirmations, dan waitlist management.',
                'content' => 'Restaurant reservation system yang memudahkan customers untuk booking table online. Restaurant owners dapat manage reservations, table layouts, dan view analytics. Fitur meliputi: real-time table availability, automated confirmation emails, waitlist system, customer database, dan reporting dashboard.',
                'image' => 'https://via.placeholder.com/800x600/f39c12/ffffff?text=Restaurant+Booking',
                'url' => 'https://example-restaurant.com',
                'repository' => null, // Private repo
                'technologies' => ['Laravel', 'Inertia.js', 'React', 'MySQL', 'SendGrid'],
                'status' => 'published',
                'started_at' => '2024-02-20',
                'completed_at' => '2024-05-30',
                'is_featured' => false,
                'order' => 4,
            ],
            [
                'title' => 'API Gateway Service',
                'description' => 'Microservices API gateway dengan rate limiting, authentication, caching, dan load balancing untuk enterprise applications.',
                'content' => 'API Gateway yang dibangun untuk handle multiple microservices. Menyediakan single entry point untuk semua services dengan built-in security, monitoring, dan caching. Fitur meliputi: JWT authentication, rate limiting, request/response caching, load balancing, API documentation dengan Swagger, dan centralized logging.',
                'image' => 'https://via.placeholder.com/800x600/9b59b6/ffffff?text=API+Gateway',
                'url' => null,
                'repository' => null,
                'technologies' => ['Laravel', 'Redis', 'JWT', 'Docker', 'Nginx'],
                'status' => 'draft',
                'started_at' => '2024-08-01',
                'completed_at' => null,
                'is_featured' => false,
                'order' => 5,
            ],
            [
                'title' => 'Real Estate Listing Platform',
                'description' => 'Platform untuk listing dan mencari properti dengan advanced search filters, virtual tours, dan agent management system.',
                'content' => 'Real estate platform yang memungkinkan agents untuk list properties dan buyers untuk search berdasarkan various criteria. Fitur meliputi: advanced property search dengan filters, image galleries dengan virtual tour support, agent profiles dan contact system, favorite properties, dan price comparison tools.',
                'image' => 'https://via.placeholder.com/800x600/1abc9c/ffffff?text=Real+Estate',
                'url' => 'https://example-realestate.com',
                'repository' => 'https://github.com/example/realestate',
                'technologies' => ['Laravel', 'Vue.js', 'Google Maps API', 'MySQL', 'Elasticsearch'],
                'status' => 'published',
                'started_at' => '2024-04-01',
                'completed_at' => '2024-09-15',
                'is_featured' => true,
                'order' => 6,
            ],
        ];

        // Loop untuk create semua sample projects
        // Menggunakan user_id dari admin yang sudah dibuat
        foreach ($projects as $projectData) {
            Project::create(array_merge($projectData, [
                'user_id' => $admin->id,
            ]));
        }

        // Output message untuk konfirmasi
        $this->command->info('Sample projects created successfully!');
        $this->command->info('Admin credentials: admin@portfolio.com / password');
    }
}

