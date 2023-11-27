<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfUserHasNotEnabledStripe;
use Illuminate\Http\Request;

class ProductIndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', RedirectIfUserHasNotEnabledStripe::class]);
    }

    public function __invoke(Request $request)
    {
        return view('products.index', [
            'products' => $request->user()->products()->latest()->get(),
        ]);
    }
}
