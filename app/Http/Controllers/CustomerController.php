<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Models\Router;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index()
    {
        $customers = Customer::with(['user', 'router'])
            ->latest()
            ->paginate(10);

        return view('in.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new customer.
     */
    public function create()
    {
        $availableRouters = Router::whereNull('customer_id')->get();
        return view('in.customers.create', compact('availableRouters'));
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|unique:customers,phone',
            'address' => 'nullable|string',
            'location' => 'nullable|string',
            'router_serial' => 'nullable|exists:routers,serial_number'
        ]);

        // Create user first
        $user = User::create([
            'role_id' => 3, // Assuming 3 is the role_id for customers
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ]);

        // Create customer
        $customer = Customer::create([
            'user_id' => $user->id,
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'location' => $validated['location'],
            'router_serial' => $validated['router_serial'] ?? null,
        ]);

        // If router serial is provided, associate it with the customer
        if ($request->filled('router_serial')) {
            $router = Router::where('serial_number', $validated['router_serial'])->first();
            if ($router) {
                $router->update(['customer_id' => $customer->id]);
            }
        }

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified customer.
     */
    public function show(Customer $customer)
    {
        $customer->load(['user', 'router']);
        return view('in.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(Customer $customer)
    {
        $customer->load(['user', 'router']);
        $availableRouters = Router::whereNull('customer_id')
            ->orWhere('customer_id', $customer->id)
            ->get();

        return view('in.customers.edit', compact('customer', 'availableRouters'));
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($customer->user_id)
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($customer->user_id)
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'full_name' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                Rule::unique('customers')->ignore($customer->id)
            ],
            'address' => 'nullable|string',
            'location' => 'nullable|string',
            'router_serial' => 'nullable|exists:routers,serial_number'
        ]);

        // Update user
        $userData = [
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $customer->user->update($userData);

        // Update customer
        $customerData = [
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'location' => $validated['location'],
            'router_serial' => $validated['router_serial'] ?? null,
        ];

        $customer->update($customerData);

        // Handle router association
        if ($request->filled('router_serial')) {
            // Remove current router association
            if ($customer->router) {
                $customer->router->update(['customer_id' => null]);
            }

            // Associate new router
            $router = Router::where('serial_number', $validated['router_serial'])->first();
            if ($router) {
                $router->update(['customer_id' => $customer->id]);
            }
        } else {
            // Remove router association if no router serial provided
            if ($customer->router) {
                $customer->router->update(['customer_id' => null]);
            }
        }

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(Customer $customer)
    {
        // This will also delete the associated user due to onDelete('cascade')
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }

    /**
     * Get customer details by ID
     */
    public function getCustomerDetails($id)
    {
        $customer = Customer::with(['user', 'router'])->findOrFail($id);
        
        return response()->json([
            'customer' => $customer,
            'user' => $customer->user,
            'router' => $customer->router
        ]);
    }

    /**
     * Search customers
     */
    public function search(Request $request)
    {
        $search = $request->get('search');
        
        $customers = Customer::with(['user', 'router'])
            ->where('full_name', 'like', "%{$search}%")
            ->orWhere('phone', 'like', "%{$search}%")
            ->orWhere('router_serial', 'like', "%{$search}%")
            ->orWhereHas('user', function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('customers.index', compact('customers'));
    }

    /**
     * Get customers by location
     */
    public function getByLocation($location)
    {
        $customers = Customer::with(['user', 'router'])
            ->where('location', $location)
            ->where('status', 'active')
            ->get();

        return response()->json($customers);
    }

    /**
     * Assign router to customer
     */
    public function assignRouter(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'router_serial' => 'required|exists:routers,serial_number'
        ]);

        $router = Router::where('serial_number', $validated['router_serial'])->first();

        if ($router->customer_id && $router->customer_id !== $customer->id) {
            return back()->with('error', 'Router is already assigned to another customer.');
        }

        $router->update(['customer_id' => $customer->id]);
        $customer->update(['router_serial' => $validated['router_serial']]);

        return back()->with('success', 'Router assigned successfully.');
    }

    /**
     * Remove router from customer
     */
    public function removeRouter(Customer $customer)
    {
        if ($customer->router) {
            $customer->router->update(['customer_id' => null]);
            $customer->update(['router_serial' => null]);
        }

        return back()->with('success', 'Router removed successfully.');
    }
}