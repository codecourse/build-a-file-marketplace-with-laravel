<?php

namespace App\Http\Controllers\Subdomain;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class SubdomainProductCheckoutSuccessController extends Controller
{
    public function __invoke(User $user, Product $product)
    {
        return view('subdomain.products.checkout.success', [
            'product' => $product
        ]);
    }
}
