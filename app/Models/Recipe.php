<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recipe extends Model
{
    protected $table = 'recipes';

    protected $fillable = [
        'title',
        'desc',
        'tags',
        'url',
        'prep_time',
        'cook_time',
        'image_url',
        'ingredients',
        'instructions',
        'servings',
        'created_by'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
