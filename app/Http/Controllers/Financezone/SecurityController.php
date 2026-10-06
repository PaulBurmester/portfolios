<?php

namespace App\Http\Controllers\Financezone;

use App\Http\Controllers\Controller;
use App\Models\Security;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'ticker' => ['required', 'max:5'],
            'ISIN' => ['unique:securities,ISIN', 'required', 'size:12'],
            'price' => ['nullable', 'decimal:2'],
            'type' => ['nullable'],
        ], [
            'name.required' => 'You need to enter a Name',
            'name.min' => 'The Name must have at least 3 characters',
            'ticker.required' => 'You need to enter a Ticker',
            'ticker.max' => 'Ticker can not be longer than 5 characters',
            'ISIN.unique' => 'There is already a Security with this ISIN',
            'ISIN.required' => 'You need to enter an ISIN',
            'ISIN.size' => 'The ISIN needs to be 12 characters long',
            'price' => 'The price needs to have two decimal places',
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
    public function edit(Security $security)
    {
        return view('financezone.security.edit', ['security' => $security]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Security $security)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'ticker' => ['required', 'max:5'],
            'ISIN' => ['required', 'size:12', Rule::unique('securities', 'ISIN')->ignore($security)],
            'price' => ['nullable', 'decimal:2'],
            'type' => ['nullable'],
        ], [
            'name.required' => 'You need to enter a Name',
            'name.min' => 'The Name must have at least 3 characters',
            'ticker.required' => 'You need to enter a Ticker',
            'ticker.max' => 'Ticker can not be longer than 5 characters',
            'ISIN.unique' => 'There is already a Security with this ISIN',
            'ISIN.required' => 'You need to enter an ISIN',
            'ISIN.size' => 'The ISIN needs to be 12 characters long',
            'price' => 'The price needs to have two decimal places',
        ]);

        $security->update($validated);

        return redirect()->route('security.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Security $security)
    {
        if ($security->holdings()->exists()) {
            return redirect()->route('security.index')->with('error', 'Security is in an Active Portfolio!');
        }
        $security->delete();

        return redirect()->route('security.index');
    }
}
