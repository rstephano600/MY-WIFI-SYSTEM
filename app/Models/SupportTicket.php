<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'subject',
        'message',
        'status',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Helper methods
    public function isOpen()
    {
        return $this->status === 'open';
    }

    public function isInProgress()
    {
        return $this->status === 'in_progress';
    }

    public function isClosed()
    {
        return $this->status === 'closed';
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'open' => 'red',
            'in_progress' => 'yellow',
            'closed' => 'green',
            default => 'gray',
        };
    }
}
