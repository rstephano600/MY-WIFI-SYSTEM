<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'address',
        'router_serial',
        'location',
        'registration_date',
    ];

    protected $casts = [
        'registration_date' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function router()
    {
        return $this->hasOne(Router::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    // Helper methods
    public function activeSubscription()
    {
        return $this->subscriptions()->where('status', 'active')->first();
    }

    public function hasActiveSubscription()
    {
        return $this->subscriptions()->where('status', 'active')->exists();
    }
}
