<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $guarded = [];

    /**
     * Get all of the comments for the Blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * The tag that belong to the Blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        // return $this->belongsToMany(Tag::class, 'blog_tag', 'blog_id', 'tag_id');
        return $this->belongsToMany(Tag::class); //jika pake aturan dari laravelnya cukup begini
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    //relasi one to one polymorph
    public function rating()
    {
        return $this->morphMany(Rating::class, 'ratingable');
    }
}
