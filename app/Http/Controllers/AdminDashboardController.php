<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\SupportTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Summary cards
        $totalCustomers = Customer::count();
        $activeSubscriptions = Subscription::where('status', 'active')->count();
        $monthlyRevenue = Payment::whereYear('payment_date', Carbon::now()->year)
            ->whereMonth('payment_date', Carbon::now()->month)
            ->sum('amount');
        $openTickets = SupportTicket::where('status', 'open')->count();

        // Trends for Chart.js
        $revenueData = $this->getRevenueData();
        $bundleData = $this->getBundleDistribution();

        // Recent data tables
        $recentCustomers = Customer::latest()->take(5)->get();
        $recentTickets = SupportTicket::with('customer')->latest()->take(5)->get();
        $recentActivity = $this->getRecentActivity();

        return view('in.admin.dashboard', compact(
            'totalCustomers',
            'activeSubscriptions',
            'monthlyRevenue',
            'openTickets',
            'revenueData',
            'bundleData',
            'recentCustomers',
            'recentTickets',
            'recentActivity'
        ));
    }

    /**
     * Get revenue data for the last 12 months
     */
    private function getRevenueData()
    {
        $labels = [];
        $data = [];
        
        // Get last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $labels[] = $date->format('M Y');
            
            $revenue = Payment::whereYear('payment_date', $date->year)
                ->whereMonth('payment_date', $date->month)
                ->sum('amount');
            
            $data[] = (float) $revenue;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get bundle distribution data
     */
    private function getBundleDistribution()
    {
        $distribution = Subscription::where('status', 'active')
            ->with('bundle')
            ->select('bundle_id', \DB::raw('COUNT(*) as total'))
            ->groupBy('bundle_id')
            ->get()
            ->map(function ($row) {
                return [
                    'bundle' => $row->bundle->name ?? 'Unknown',
                    'count' => (int) $row->total,
                ];
            })
            ->toArray();

        // Return empty array if no data
        return $distribution ?: [];
    }

    /**
     * Get recent system activity from real records
     */
    private function getRecentActivity()
    {
        $activities = collect();

        try {
            // 🧩 1. Recent customers
            $recentCustomers = Customer::latest()->take(3)->get();
            foreach ($recentCustomers as $customer) {
                $activities->push([
                    'user' => 'System',
                    'action' => 'New Customer Registered',
                    'details' => $customer->first_name . ' ' . $customer->last_name . ' (' . $customer->phone_number . ')',
                    'timestamp' => $customer->created_at->toDateTimeString(),
                ]);
            }

            // 🧩 2. Recent subscriptions
            $recentSubscriptions = Subscription::with(['customer', 'bundle'])
                ->latest()
                ->take(3)
                ->get();
            
            foreach ($recentSubscriptions as $sub) {
                $customerName = optional($sub->customer)->first_name ?? 'Unknown Customer';
                $bundleName = optional($sub->bundle)->name ?? 'Unknown Bundle';
                
                $activities->push([
                    'user' => 'System',
                    'action' => 'Subscription Created',
                    'details' => $bundleName . ' for ' . $customerName,
                    'timestamp' => $sub->created_at->toDateTimeString(),
                ]);
            }

            // 🧩 3. Recent payments
            $recentPayments = Payment::with('customer')
                ->latest('payment_date')
                ->take(3)
                ->get();
            
            foreach ($recentPayments as $pay) {
                $customerName = optional($pay->customer)->first_name . ' ' . optional($pay->customer)->last_name;
                $customerName = trim($customerName) ?: 'Customer';
                
                $activities->push([
                    'user' => $customerName,
                    'action' => 'Payment Made',
                    'details' => 'TZS ' . number_format($pay->amount, 0) . ' via ' . strtoupper($pay->payment_method ?? 'N/A'),
                    'timestamp' => $pay->payment_date ? Carbon::parse($pay->payment_date)->toDateTimeString() : $pay->created_at->toDateTimeString(),
                ]);
            }

            // 🧩 4. Recent support tickets
            $recentTickets = SupportTicket::with('customer')
                ->latest('updated_at')
                ->take(3)
                ->get();
            
            foreach ($recentTickets as $ticket) {
                $customerName = optional($ticket->customer)->first_name . ' ' . optional($ticket->customer)->last_name;
                $customerName = trim($customerName) ?: 'Customer';
                
                $details = $ticket->subject ?: Str::limit($ticket->message ?? 'No details', 40);
                
                $activities->push([
                    'user' => $customerName,
                    'action' => 'Support Ticket ' . ucfirst(str_replace('_', ' ', $ticket->status)),
                    'details' => $details,
                    'timestamp' => $ticket->updated_at->toDateTimeString(),
                ]);
            }

            // Sort by timestamp descending and take 10 most recent
            return $activities
                ->sortByDesc('timestamp')
                ->take(10)
                ->values()
                ->toArray();
                
        } catch (\Exception $e) {
            // Log error and return empty array
            \Log::error('Error fetching recent activity: ' . $e->getMessage());
            return [];
        }
    }
}