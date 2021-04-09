<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Podcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'tags',
        'thumbnail',
        'lang',
        'style',
        'spotifypodcasts_url',
        'googlepodcasts_url',
        'applepodcasts_url'
    ];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
