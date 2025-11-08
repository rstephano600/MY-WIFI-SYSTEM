<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Bundle;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of subscriptions.
     */
    public function index()
    {
        $user = Auth::user();

        // If user is a customer, only show their own subscriptions
        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();
            $subscriptions = Subscription::with(['customer', 'bundle'])
                ->where('customer_id', $customer->id ?? null)
                ->latest()
                ->paginate(10);
        } else {
            // Admins, managers, staff, etc. can see all
            $subscriptions = Subscription::with(['customer', 'bundle'])
                ->latest()
                ->paginate(10);
        }

        return view('in.subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new subscription.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            // Customers can only create for themselves
            $customer = Customer::where('user_id', $user->id)->firstOrFail();
            $customers = collect([$customer]);
        } else {
            $customers = Customer::all();
        }

        $bundles = Bundle::all();
        return view('in.subscriptions.create', compact('customers', 'bundles'));
    }

    /**
     * Store a newly created subscription.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->firstOrFail();
            $request->merge(['customer_id' => $customer->id]); // enforce their own id
        }

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'bundle_id' => 'required|exists:bundles,id',
            'start_date' => 'required|date',
        ]);

        // Prevent customers from creating for others
        if ($user->role === 'customer' && $request->customer_id != $customer->id) {
            abort(403, 'Unauthorized action.');
        }

        $bundle = Bundle::findOrFail($request->bundle_id);
        $end_date = Carbon::parse($request->start_date)->addDays($bundle->duration_days);

        Subscription::create([
            'customer_id' => $request->customer_id,
            'bundle_id' => $bundle->id,
            'start_date' => $request->start_date,
            'end_date' => $end_date,
            'remaining_data_gb' => $bundle->data_size_gb,
            'status' => 'active',
        ]);

        return redirect()->route('subscriptions.index')->with('success', 'Subscription created successfully.');
    }

    /**
     * Display the specified subscription.
     */
    public function show(Subscription $subscription)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();
            if ($subscription->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }
        }

        $subscription->load(['customer', 'bundle']);
        return view('in.subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified subscription.
     */
    public function edit(Subscription $subscription)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();
            if ($subscription->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }

            // Customer can only edit their own
            $customers = collect([$customer]);
        } else {
            $customers = Customer::all();
        }

        $bundles = Bundle::all();
        return view('in.subscriptions.edit', compact('subscription', 'customers', 'bundles'));
    }

    /**
     * Update the specified subscription.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {

                abort(403, 'Unauthorized action.');
            

            // Force their own customer_id
            $request->merge(['customer_id' => $customer->id]);
        }

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'bundle_id' => 'required|exists:bundles,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'remaining_data_gb' => 'required|numeric|min:0',
            'status' => 'required|in:active,expired,pending',
        ]);

        $subscription->update($request->all());

        return redirect()->route('subscriptions.index')->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified subscription.
     */
    public function destroy(Subscription $subscription)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();
            if ($subscription->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }
        }

        $subscription->delete();
        return redirect()->route('subscriptions.index')->with('success', 'Subscription deleted successfully.');
    }
}
