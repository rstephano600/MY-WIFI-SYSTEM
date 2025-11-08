<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use Illuminate\Http\Request;

class BundleController extends Controller
{
    /**
     * Display a listing of the bundles.
     */
    public function index()
    {
        $bundles = Bundle::latest()->paginate(10);
        return view('in.bundles.index', compact('bundles'));
    }

    /**
     * Show the form for creating a new bundle.
     */
    public function create()
    {
        return view('in.bundles.create');
    }

    /**
     * Store a newly created bundle in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'data_size_gb' => 'required|numeric|min:0.1',
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ]);

        Bundle::create($request->all());

        return redirect()->route('bundles.index')
                         ->with('success', 'Bundle created successfully.');
    }

    /**
     * Display the specified bundle.
     */
    public function show(Bundle $bundle)
    {
        return view('in.bundles.show', compact('bundle'));
    }

    /**
     * Show the form for editing the specified bundle.
     */
    public function edit(Bundle $bundle)
    {
        return view('in.bundles.edit', compact('bundle'));
    }

    /**
     * Update the specified bundle in storage.
     */
    public function update(Request $request, Bundle $bundle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'data_size_gb' => 'required|numeric|min:0.1',
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ]);

        $bundle->update($request->all());

        return redirect()->route('bundles.index')
                         ->with('success', 'Bundle updated successfully.');
    }

    /**
     * Remove the specified bundle from storage.
     */
    public function destroy(Bundle $bundle)
    {
        $bundle->delete();

        return redirect()->route('bundles.index')
                         ->with('success', 'Bundle deleted successfully.');
    }
}
