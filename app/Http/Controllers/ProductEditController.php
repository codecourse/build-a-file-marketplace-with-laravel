<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfUserHasNotEnabledStripe;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductEditController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', RedirectIfUserHasNotEnabledStripe::class]);
    }

    public function __invoke(Product $product)
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }
}
