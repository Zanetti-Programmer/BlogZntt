<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'conteudo', 'capa', 'data_publicacao'];

    public function developers()
    {
        return $this->belongsToMany(Developer::class, 'article_developer');
    }
}

