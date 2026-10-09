<?php

namespace App\Http\Controllers\Financezone;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Security;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HoldingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Portfolio $portfolio)
    {
        Gate::authorize('view', $portfolio);

        $holdings = $portfolio->holdings()->with('security')->get();

        return view('financezone.holding.index', ['holdings' => $holdings, 'portfolio' => $portfolio]);
    }

    public function create(Portfolio $portfolio)
    {
        Gate::authorize('update', $portfolio);

        $securities = Security::get();

        return view('financezone.holding.create', ['securities' => $securities, 'portfolio' => $portfolio]);
    }

    public function store(Request $request, Portfolio $portfolio)
    {
        Gate::authorize('update', $portfolio);

        $validated = $request->validate([
            'security_id' => ['required', 'exists:securities,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'purchase_date' => ['required', 'date', 'before_or_equal:today'],
        ], [
            'security_id.required' => 'Please Choose a Security',
            'security_id.exists' => 'Please Choose a Security',
            'quantity.required' => 'Please give a number of shares',
            'quantity.integer' => 'Must be a Number',
            'quantity.min' => 'Must be a positive Number',
            'purchase_price.required' => 'Please give a purchase price per share',
            'purchase_price.numeric' => 'Must be a Number',
            'purchase_price.min' => 'Must be a positive Number',
            'purchase_date.required' => 'Choose a date',
            'purchase_date.date' => 'Choose a date',
            'purchase_date.before_or_equal' => 'Choose a date that is not in the future',
        ]);

        $portfolio->holdings()->create($validated);

        return redirect()->route('holding.index', ['portfolio' => $portfolio]);
    }
}
