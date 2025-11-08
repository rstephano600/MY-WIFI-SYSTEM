<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Payment;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please complete your customer profile first.');
        }

        // Active subscription
        $activeSubscription = Subscription::with('bundle')
            ->where('customer_id', $customer->id)
            ->where('status', 'active')
            ->latest()
            ->first();

        // Recent payments
        $recentPayments = Payment::where('customer_id', $customer->id)
            ->latest()
            ->take(5)
            ->get();

        // Recent tickets
        $recentTickets = SupportTicket::where('customer_id', $customer->id)
            ->latest()
            ->take(5)
            ->get();

        return view('in.customer.dashboard', compact(
            'customer',
            'activeSubscription',
            'recentPayments',
            'recentTickets'
        ));
    }
}
