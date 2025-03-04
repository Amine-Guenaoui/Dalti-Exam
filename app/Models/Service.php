<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug_name',
        'description',
        'price',
        'duration',
        'is_active',
        'category_id',
        'settings'
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean',
        'price' => 'float',
        'duration' => 'integer'
    ];

    /**
     * Get the category that the service belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }
}
