<?php

namespace App\Http\Controllers\Subdomain;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class SubdomainProductCheckoutController extends Controller
{
    public function __invoke(User $user, Product $product)
    {
        $response = app('stripe')->checkout->sessions->create([
            'mode' => 'payment',
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => $product->price->getAmount(),
                        'product_data' => [
                            'name' => $product->title,
                        ]
                    ],
                    'quantity' => 1
                ]
            ],
            'payment_intent_data' => [
                'application_fee_amount' => $product->applicationFeeAmount()->getAmount(),
            ],
            'success_url' => route('subdomain.products.checkout.success', [$user->subdomain, $product->slug]),
            'cancel_url' => route('subdomain.products.show', [$user->subdomain, $product->slug]),
            'metadata' => [
                'product_id' => $product->id,
            ]
        ], [
            'stripe_account' => $product->user->stripe_account_id,
        ]);

        return redirect($response->url);
    }
}
