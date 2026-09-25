<?php

namespace App\Http\Controllers\Financezone;

use App\Http\Controllers\Controller;
use App\Models\Security;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $securities = Security::all();
        return view('financezone.security.index', ['securities' => $securities]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('financezone.security.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'ticker' => ['required', 'min:1', 'max:5'],
            'ISIN' => ['unique:securities,ISIN', 'required', 'size:12'],
            'price' => ['nullable', 'decimal:2'],
            'type' => ['nullable'],
        ]);

        Security::create($validated);

        return redirect()->route('security.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
