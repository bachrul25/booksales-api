<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'title',
            'author_id',
            'description',
            'published_date'
        ];

    protected $casts = [
        'published_date' => 'date'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Tambahkan di dalam class Book
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

}
