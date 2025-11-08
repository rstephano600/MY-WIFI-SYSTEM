<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Router;
use App\Models\Bundle;
use App\Models\Payment;


use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'manager':
                return view('in.manager.dashboard');
            case 'staff':
                return view('in.staff.dashboard');
            case 'customer_care':
                return view('in.customer-care.dashboard');
            case 'customer':
                return redirect()->route('customer.dashboard');
            default:
                abort(403, 'Unauthorized access.');
        }
    }


    public function index2()
    {
        return view('dashboard', [
            'usersCount' => User::count(),
            'customersCount' => Customer::count(),
            'routersCount' => Router::count(),
            'bundlesCount' => Bundle::count(),
            'payments' => Payment::with('customer')->latest()->take(5)->get(),
        ]);
    }
}
