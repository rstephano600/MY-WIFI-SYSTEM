<?php

namespace App\Http\Controllers;

use App\Models\Router;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouterController extends Controller
{
    /**
     * Display a listing of routers.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();

            $routers = Router::with('customer')
                ->where('customer_id', $customer->id ?? null)
                ->latest()
                ->paginate(10);
        } else {
            $routers = Router::with('customer')
                ->latest()
                ->paginate(10);
        }

        return view('in.routers.index', compact('routers'));
    }

    /**
     * Show the form for creating a new router.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            // Customers can only assign routers to themselves
            $customer = Customer::where('user_id', $user->id)->firstOrFail();
            $customers = collect([$customer]);
        } else {
            $customers = Customer::all();
        }

        return view('in.routers.create', compact('customers'));
    }

    /**
     * Store a newly created router in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            // Customers can only assign router to their own record
            $customer = Customer::where('user_id', $user->id)->firstOrFail();
            $request->merge(['customer_id' => $customer->id]);
        }

        $request->validate([
            'serial_number' => 'required|unique:routers,serial_number|max:100',
            'model' => 'required|string|max:100',
            'customer_id' => 'nullable|exists:customers,id',
            'wifi_name' => 'required|string|max:100',
            'wifi_password' => 'required|string|max:100',
            'status' => 'required|in:active,inactive',
            'registered_date' => 'required|date',
        ]);

        // Prevent customers from assigning to someone else
        if ($user->role === 'customer' && $request->customer_id != $customer->id) {
            abort(403, 'Unauthorized action.');
        }

        Router::create($request->all());

        return redirect()->route('routers.index')
            ->with('success', 'Router registered successfully.');
    }

    /**
     * Display the specified router.
     */
    public function show(Router $router)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();
            if ($router->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }
        }

        $router->load('customer');
        return view('in.routers.show', compact('router'));
    }

    /**
     * Show the form for editing the specified router.
     */
    public function edit(Router $router)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();

            if ($router->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }

            $customers = collect([$customer]);
        } else {
            $customers = Customer::all();
        }

        return view('in.routers.edit', compact('router', 'customers'));
    }

    /**
     * Update the specified router in storage.
     */
    public function update(Request $request, Router $router)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();

            if ($router->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }

            // Force router to remain under the same customer
            $request->merge(['customer_id' => $customer->id]);
        }

        $request->validate([
            'serial_number' => 'required|max:100|unique:routers,serial_number,' . $router->id,
            'model' => 'required|string|max:100',
            'customer_id' => 'nullable|exists:customers,id',
            'wifi_name' => 'required|string|max:100',
            'wifi_password' => 'required|string|max:100',
            'status' => 'required|in:active,inactive',
            'registered_date' => 'required|date',
        ]);

        $router->update($request->all());

        return redirect()->route('routers.index')
            ->with('success', 'Router updated successfully.');
    }

    /**
     * Remove the specified router from storage.
     */
    public function destroy(Router $router)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();

            if ($router->customer_id !== ($customer->id ?? null)) {
                abort(403, 'Unauthorized action.');
            }
        }

        $router->delete();

        return redirect()->route('routers.index')
            ->with('success', 'Router deleted successfully.');
    }
}
