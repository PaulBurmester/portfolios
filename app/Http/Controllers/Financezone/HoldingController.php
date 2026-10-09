<?php

namespace App\Http\Controllers\Financezone;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Security;
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
}
