<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Migration ini membuat tabel 'projects' untuk menyimpan data portfolio.
     * Tabel ini berisi informasi tentang project yang akan ditampilkan di website portfolio.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            // Primary key - ID unik untuk setiap project
            $table->id();
            
            // Foreign key - ID user yang membuat project ini
            // Menggunakan unsignedBigInteger karena id() di tabel users adalah bigint
            $table->unsignedBigInteger('user_id');
            
            // Judul project - required, max 255 karakter
            $table->string('title');
            
            // Deskripsi singkat project - untuk preview di listing
            $table->text('description');
            
            // Konten lengkap project - untuk detail page
            $table->longText('content')->nullable();
            
            // URL gambar/thumbnail project
            $table->string('image')->nullable();
            
            // URL project (jika sudah live)
            $table->string('url')->nullable();
            
            // URL repository (GitHub, GitLab, dll)
            $table->string('repository')->nullable();
            
            // Teknologi yang digunakan (disimpan sebagai JSON array)
            // Contoh: ["Laravel", "Vue.js", "Tailwind CSS"]
            $table->json('technologies')->nullable();
            
            // Status project: draft, published, archived
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            
            // Tanggal mulai project
            $table->date('started_at')->nullable();
            
            // Tanggal selesai project
            $table->date('completed_at')->nullable();
            
            // Apakah project ini featured/unggulan?
            $table->boolean('is_featured')->default(false);
            
            // Urutan tampilan (untuk sorting manual)
            $table->integer('order')->default(0);
            
            // Timestamps otomatis: created_at dan updated_at
            $table->timestamps();
            
            // Soft deletes - untuk restore data yang dihapus
            $table->softDeletes();
            
            // Foreign key constraint ke tabel users
            // onDelete('cascade') berarti jika user dihapus, project-nya ikut terhapus
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            
            // Index untuk performa query yang lebih baik
            $table->index('user_id');
            $table->index('status');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     * 
     * Method ini akan dijalankan saat rollback migration.
     * Menghapus tabel 'projects' dari database.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
