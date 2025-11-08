<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Router extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'model',
        'customer_id',
        'wifi_name',
        'wifi_password',
        'status',
        'registered_date',
    ];

    protected $casts = [
        'registered_date' => 'datetime',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Helper methods
    public function isActive()
    {
        return $this->status === 'active';
    }

    public function isAssigned()
    {
        return !is_null($this->customer_id);
    }
}
