<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media';

    protected $fillable = [
        'provider_id',
        'original_title',
        'title',
        'overview',
        'release_date',
        'provider_vote_average',
        'provider_vote_count',
        'poster_path'
    ];

    
}
