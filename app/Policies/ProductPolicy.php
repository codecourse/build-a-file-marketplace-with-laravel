<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function show(?User $user, Product $product)
    {
        return $product->live === true;
    }
}
