<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Podcast extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'team_id',
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
        'applepodcasts_url',
        'is_public',
        'explicit',
        'website_style'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['episodes'];


    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'podcast_user', 'podcast_id', 'user_id');
    }

    /**
     * The relationship between a podcast and a team
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
