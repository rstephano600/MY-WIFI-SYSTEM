<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'data_size_gb',
        'duration_days',
        'price',
        'description',
    ];

    protected $casts = [
        'data_size_gb' => 'decimal:2',
        'price' => 'decimal:2',
        'duration_days' => 'integer',
    ];

    // Relationships
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // Helper methods
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2);
    }

    public function getFormattedDataSizeAttribute()
    {
        return $this->data_size_gb . ' GB';
    }
}