<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Customer;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display all payments.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();

            $payments = Payment::with(['customer', 'subscription'])
                ->where('customer_id', $customer->id ?? null)
                ->latest()
                ->paginate(10);
        } else {
            $payments = Payment::with(['customer', 'subscription'])
                ->latest()
                ->paginate(10);
        }

        return view('in.payments.index', compact('payments'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->firstOrFail();

            $customers = collect([$customer]);
            $subscriptions = Subscription::where('customer_id', $customer->id)->get();
        } else {
            $customers = Customer::all();
            $subscriptions = Subscription::all();
        }

        return view('in.payments.create', compact('customers', 'subscriptions'));
    }

    /**
     * Store payment.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->firstOrFail();
            $request->merge(['customer_id' => $customer->id]); // enforce their own customer_id
        }

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'subscription_id' => 'nullable|exists:subscriptions,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,mpesa,airtelmoney,ttcl_app',
            'transaction_id' => 'nullable|string|max:255',
            'payment_date' => 'required|date',
        ]);

        // Prevent customers from creating payments for others
        if ($user->role === 'customer' && $request->customer_id != $customer->id) {
            abort(403, 'Unauthorized action.');
        }

        Payment::create($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully.');
    }

    /**
     * Show single payment.
     */
    public function show(Payment $payment)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();

            if ($payment->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }
        }

        return view('in.payments.show', compact('payment'));
    }

    /**
     * Show edit form.
     */
    public function edit(Payment $payment)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();

            if ($payment->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }

            $customers = collect([$customer]);
            $subscriptions = Subscription::where('customer_id', $customer->id)->get();
        } else {
            $customers = Customer::all();
            $subscriptions = Subscription::all();
        }

        return view('in.payments.edit', compact('payment', 'customers', 'subscriptions'));
    }

    /**
     * Update payment.
     */
    public function update(Request $request, Payment $payment)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();

            if ($payment->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }

            // Force the customer's own ID
            $request->merge(['customer_id' => $customer->id]);
        }

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'subscription_id' => 'nullable|exists:subscriptions,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,mpesa,airtelmoney,ttcl_app',
            'transaction_id' => 'nullable|string|max:255',
            'payment_date' => 'required|date',
        ]);

        $payment->update($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    /**
     * Delete payment.
     */
    public function destroy(Payment $payment)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();

            if ($payment->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }
        }

        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
