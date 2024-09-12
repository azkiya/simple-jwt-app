<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;


class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default 10 items per page, bisa disesuaikan
        $packages = Package::paginate($perPage);

        return response()->json($packages);
    }

    // Store a new package
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|integer',
            'courier' => 'required|integer',
            'name' => 'required|string',
            'address' => 'required|string',
            'destination' => 'required|integer',
            'origin' => 'required|integer',
            'weight' => 'required|integer',
        ]);

        $package = Package::create($validated);
        return response()->json($package, 201);
    }

    // Show a specific package
    public function show($id)
    {
        $package = Package::find($id);

        if (!$package) {
            return response()->json(['message' => 'Package not found'], 404);
        }

        return response()->json($package);
    }

    // Update a specific package
    public function update(Request $request, $id)
    {
        $package = Package::find($id);

        if (!$package) {
            return response()->json(['message' => 'Package not found'], 404);
        }

        $validated = $request->validate([
            'order_id' => 'required|integer',
            'courier' => 'required|integer',
            'name' => 'required|string',
            'address' => 'required|string',
            'destination' => 'required|integer',
            'origin' => 'required|integer',
            'weight' => 'required|integer',
        ]);

        $package->update($validated);

        return response()->json($package);
    }

    // Delete a specific package
    public function destroy($id)
    {
        $package = Package::find($id);

        if (!$package) {
            return response()->json(['message' => 'Package not found'], 404);
        }

        $package->delete();
        return response()->json(['message' => 'Package deleted successfully']);
    }
}
