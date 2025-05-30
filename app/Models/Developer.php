<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'foto', 'biografia'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_developer');
    }
}
