<?php

namespace App\Http\Controllers\Financezone;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $portfolios = $user->portfolios;

        return view('financezone.portfolio.index', ['portfolios' => $portfolios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('financezone.portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3'],

        ], [
            'name.required' => 'You need to enter a Name',
            'name.min' => 'The Name must have at least 3 characters',
        ]);

        $request->user()->portfolios()->create($validated);

        return redirect()->route('portfolio.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portfolio $portfolio)
    {
        Gate::authorize('update', $portfolio);

        return view('financezone.portfolio.edit', ['portfolio' => $portfolio]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        Gate::authorize('update', $portfolio);

        $validated = $request->validate([
            'name' => ['required', 'min:3'],
        ], [
            'name.required' => 'You need to enter a Name',
            'name.min' => 'The Name must have at least 3 characters',
        ]);

        $portfolio->update($validated);

        return redirect()->route('portfolio.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        //
    }
}
