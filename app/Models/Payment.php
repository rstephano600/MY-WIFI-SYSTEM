<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'subscription_id',
        'amount',
        'payment_method',
        'transaction_id',
        'payment_date',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    // Helper methods
    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 2);
    }

    public function getPaymentMethodNameAttribute()
    {
        return match($this->payment_method) {
            'cash' => 'Cash',
            'mpesa' => 'M-Pesa',
            'airtelmoney' => 'Airtel Money',
            'ttcl_app' => 'TTCL App',
            default => ucfirst($this->payment_method),
        };
    }
}
