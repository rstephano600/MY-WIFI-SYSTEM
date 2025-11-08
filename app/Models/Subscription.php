<?php

// ============================================

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'bundle_id',
        'start_date',
        'end_date',
        'remaining_data_gb',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'remaining_data_gb' => 'decimal:2',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Helper methods
    public function isActive()
    {
        return $this->status === 'active';
    }

    public function isExpired()
    {
        return $this->status === 'expired' || Carbon::now()->isAfter($this->end_date);
    }

    public function daysRemaining()
    {
        return Carbon::now()->diffInDays($this->end_date, false);
    }

    public function dataUsagePercentage()
    {
        if ($this->bundle->data_size_gb == 0) return 0;
        $used = $this->bundle->data_size_gb - $this->remaining_data_gb;
        return ($used / $this->bundle->data_size_gb) * 100;
    }
}