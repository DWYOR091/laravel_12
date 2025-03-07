<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $guarded = [];


    //relasi one to one polymorph
    public function rating()
    {
        return $this->morphMany(Rating::class, 'ratingable', 'ratingable_id', 'ratingable_type');
    }
}
