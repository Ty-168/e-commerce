<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Article extends Model
{
    
    protected $fillable = ['name', 'author_id'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
    
    //Article has mant audiences
    public function audience(): HasMany
    {
        return $this->hasMany(Audience::class);
    }

    // Article has many comments
    public function comment(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
