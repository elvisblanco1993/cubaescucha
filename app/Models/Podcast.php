<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Podcast extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'url',
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

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        unset($array['updated_at']);

        return $array;
    }
}
