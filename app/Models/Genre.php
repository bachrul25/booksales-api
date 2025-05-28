<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Genre extends Model
{
    use HasFactory;

    // Nama tabel jika tidak sesuai konvensi Laravel
    // protected $table = 'genres';

    protected $fillable = ['name', 'description', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($genre) {
            $genre->slug = Str::slug($genre->name);
        });

        static::updating(function ($genre) {
            $genre->slug = Str::slug($genre->name);
        });
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
