<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifyStripeWebhookSignature;
use App\Mail\PurchaseConfirmation;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StripeWebhookController extends Controller
{
    public function __construct()
    {
        $this->middleware(VerifyStripeWebhookSignature::class);
    }

    public function __invoke(Request $request)
    {
        $payload = json_decode($request->getContent(), true);

        $method = 'handle' . Str::studly(str_replace('.', '_', $payload['type']));

        if (method_exists($this, $method)) {
            $response = $this->{$method}($payload);

            return $response;
        }

        return new Response();
    }

    protected function handleCheckoutSessionCompleted(array $payload)
    {
        $sale = Product::findOrFail($payload['data']['object']['metadata']['product_id'])->sales()->create([
            'email' => $payload['data']['object']['customer_details']['email'],
            'stripe_session_id' => $payload['data']['object']['id'],
            'price' => $payload['data']['object']['amount_subtotal'],
            'paid_at' => $payload['data']['object']['payment_status'] === 'paid' ? now() : null,
        ]);

        Mail::to($sale->email)->send(new PurchaseConfirmation($sale));
    }

    protected function handleCheckoutAsyncPaymentCompleted(array $payload)
    {
        //
    }
}
