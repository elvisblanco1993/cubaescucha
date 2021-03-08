<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'podcast_id',
        'title',
        'show_notes',
        'type',
        'downloadable',
        'file_name',
        'explicit',
        'season',
        'episode_no',
    ];

}
