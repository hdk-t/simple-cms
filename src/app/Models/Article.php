<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Article extends Model
{
    use HasFactory;

    public function picture(): BelongsTo
    {
        return $this->belongsTo(Picture::class);
    }

    public function articleStatus(): BelongsTo
    {
        return $this->belongsTo(ArticleStatus::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    public function getPictureUrlAttribute(): string
    {
        return is_null($this->picture()->first()) ? '' : Storage::url($this->picture()->first()->path);
    }

    /**
     * @return array<string>
     */
    public function getArticleTagsAttribute(): array
    {
        return  $this->tags()->pluck('name')->toArray();
    }
}
