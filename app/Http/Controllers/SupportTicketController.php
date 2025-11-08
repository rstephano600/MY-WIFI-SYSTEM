<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    /**
     * 🟢 List all tickets
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();

            $tickets = SupportTicket::with('customer')
                ->where('customer_id', $customer->id ?? null)
                ->latest()
                ->paginate(10);
        } else {
            $tickets = SupportTicket::with('customer')
                ->latest()
                ->paginate(10);
        }

        return view('in.support_tickets.index', compact('tickets'));
    }

    /**
     * 🟢 Show create form
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            // Customer can only create ticket for themselves
            $customer = Customer::where('user_id', $user->id)->firstOrFail();
            $customers = collect([$customer]);
        } else {
            $customers = Customer::all();
        }

        return view('in.support_tickets.create', compact('customers'));
    }

    /**
     * 🟢 Store new ticket
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            // Force the ticket to belong to the logged-in customer
            $customer = Customer::where('user_id', $user->id)->firstOrFail();
            $request->merge(['customer_id' => $customer->id]);
        }

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Prevent customers from assigning tickets to others
        if ($user->role === 'customer' && $request->customer_id != $customer->id) {
            abort(403, 'Unauthorized action.');
        }

        SupportTicket::create($request->all());

        return redirect()->route('support_tickets.index')
            ->with('success', 'Support ticket created successfully.');
    }

    /**
     * 🟢 Show ticket details
     */
    public function show(SupportTicket $support_ticket)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();

            if ($support_ticket->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }
        }

        return view('in.support_tickets.show', compact('support_ticket'));
    }

    /**
     * 🟢 Edit ticket form
     */
    public function edit(SupportTicket $support_ticket)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();

            if ($support_ticket->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }

            $customers = collect([$customer]);
        } else {
            $customers = Customer::all();
        }

        return view('in.support_tickets.edit', compact('support_ticket', 'customers'));
    }

    /**
     * 🟢 Update ticket
     */
    public function update(Request $request, SupportTicket $support_ticket)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();

            if ($support_ticket->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }

            // Ensure the ticket stays under the same customer
            $request->merge(['customer_id' => $customer->id]);
        }

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $support_ticket->update($request->all());

        return redirect()->route('support_tickets.index')
            ->with('success', 'Support ticket updated successfully.');
    }

    /**
     * 🔴 Delete ticket
     */
    public function destroy(SupportTicket $support_ticket)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();

            if ($support_ticket->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }
        }

        $support_ticket->delete();

        return redirect()->route('support_tickets.index')
            ->with('success', 'Support ticket deleted successfully.');
    }
}
