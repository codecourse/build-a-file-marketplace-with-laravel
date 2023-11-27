<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleShowController extends Controller
{
    public function __invoke(Request $request, Sale $sale)
    {
        abort_if($request->email !== $sale->email, 403);

        return view('sales.show', [
            'sale' => $sale
        ]);
    }
}
