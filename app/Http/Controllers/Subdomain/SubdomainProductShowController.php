<?php

namespace App\Http\Controllers\Subdomain;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class SubdomainProductShowController extends Controller
{
    public function __invoke(User $user, Product $product)
    {
        $this->authorize('show', $product);

        return view('subdomain.products.show', [
            'user' => $user,
            'product' => $product
        ]);
    }
}
