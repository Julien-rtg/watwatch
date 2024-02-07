<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * The providers that belong to the media.
     */
    public function providers(): BelongsToMany
    {
        return $this->belongsToMany(Provider::class);
    }
    
    /**
     * The genre that belong to the media.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'media_genre');
    }
}
