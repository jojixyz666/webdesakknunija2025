<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'kategori',
        'tampilkan',
        'urutan',
        'tanggal_publikasi',
        'user_id',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'datetime',
        'tampilkan' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : asset('images/default-news.jpg');
    }

    public function getKutipanAttribute()
    {
        return Str::limit(strip_tags($this->konten), 150);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = static::generateUniqueSlug($berita->judul);
            }
        });

        static::updating(function ($berita) {
            if ($berita->isDirty('judul')) {
                $berita->slug = static::generateUniqueSlug($berita->judul, $berita->id);
            }
        });
    }

    /**
     * Generate a unique slug from the given title
     *
     * @param string $title
     * @param int|null $ignoreId
     * @return string
     */
    protected static function generateUniqueSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        // Check if slug exists, excluding the current record if updating
        while (static::where('slug', $slug)
            ->when($ignoreId, function ($query, $ignoreId) {
                return $query->where('id', '!=', $ignoreId);
            })
            ->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
