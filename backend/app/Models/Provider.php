<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Provider extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'provider';

    protected $fillable = [
        'provider_id',
        'provider_name',
        'logo_path'
    ];

    /**
     * The medias that belong to the provider.
     */
    public function media(): BelongsToMany
    {
        return $this->belongsToMany(Media::class);
    }
}
