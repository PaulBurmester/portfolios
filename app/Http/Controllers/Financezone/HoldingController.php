<?php

namespace App\Http\Controllers\Financezone;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
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
}
