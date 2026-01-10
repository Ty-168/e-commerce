<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Author extends Model
{

    protected $fillable = ['name', 'user_id'];

    // Author has one user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Author wrote multiple article
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function audiences(): HasManyThrough
    {
        return $this->hasManyThrough(
            Audience::class,
            Article::class,
            'author_id',   // FK on articles
            'article_id',  // FK on audiences
            'id',          // PK on authors
            'id'           // PK on articles
        );
    }
}
