<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model Project
 * 
 * Model ini merepresentasikan data project/portfolio dalam aplikasi.
 * Menggunakan Eloquent ORM untuk interaksi dengan database.
 * 
 * Fitur yang digunakan:
 * - HasFactory: Untuk membuat factory/seeder data dummy
 * - SoftDeletes: Untuk soft delete (data tidak benar-benar dihapus)
 */
class Project extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel di database
     * 
     * Secara default Laravel akan menggunakan nama plural dari model (projects).
     * Tapi kita define explicit untuk clarity.
     */
    protected $table = 'projects';

    /**
     * Mass assignment protection
     * 
     * Daftar kolom yang BOLEH diisi secara mass assignment (create, update).
     * Ini adalah security feature untuk mencegah user mengisi kolom yang tidak seharusnya.
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'content',
        'image',
        'url',
        'repository',
        'technologies',
        'status',
        'started_at',
        'completed_at',
        'is_featured',
        'order',
    ];

    /**
     * Casting attributes ke tipe data tertentu
     * 
     * Laravel akan otomatis convert data sesuai tipe yang didefinisikan:
     * - technologies: JSON akan di-decode jadi array PHP
     * - is_featured: string '1'/'0' jadi boolean true/false
     * - dates: string jadi Carbon instance untuk manipulasi tanggal
     */
    protected $casts = [
        'technologies' => 'array',
        'is_featured' => 'boolean',
        'started_at' => 'date',
        'completed_at' => 'date',
    ];

    /**
     * Default values untuk attributes
     * 
     * Nilai default yang akan digunakan saat membuat instance baru
     */
    protected $attributes = [
        'status' => 'draft',
        'is_featured' => false,
        'order' => 0,
    ];

    /**
     * Relasi ke User (Many to One / Belongs To)
     * 
     * Setiap project dimiliki oleh satu user.
     * Relasi ini memungkinkan kita mengakses data user dari project:
     * $project->user->name
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk filter hanya project yang published
     * 
     * Query scope adalah cara untuk reuse query logic.
     * Cara pakai: Project::published()->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope untuk filter hanya project featured
     * 
     * Cara pakai: Project::featured()->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope untuk ordering berdasarkan kolom order
     * 
     * Cara pakai: Project::ordered()->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Accessor untuk mendapatkan excerpt dari description
     * 
     * Accessor adalah getter yang otomatis dipanggil saat akses attribute.
     * Cara pakai: $project->excerpt
     * 
     * @return string
     */
    public function getExcerptAttribute()
    {
        return str($this->description)->limit(150);
    }

    /**
     * Accessor untuk cek apakah project sudah selesai
     * 
     * Cara pakai: $project->is_completed
     * 
     * @return bool
     */
    public function getIsCompletedAttribute()
    {
        return $this->completed_at !== null;
    }
}
