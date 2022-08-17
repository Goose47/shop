<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeService
{
    /**
     * @var StripeClient
     */
    private StripeClient $stripe;

    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }

    public function getCheckoutUrl(Collection $orderItems): string
    {
        $checkoutSession = Session::create([
            'line_items' => $this->getLineItems($orderItems),
            'mode' => 'payment',
            'success_url' => env('APP_URL') . '/checkout/success',
            'cancel_url' => env('APP_URL') . '/checkout/fail'
        ]);

        return $checkoutSession->url;
    }

    private function getLineItems($orderItems): array
    {
        $lineItems = [];

        foreach($orderItems as $orderItem) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $orderItem->product->name
                    ],
                    'unit_amount' => $orderItem->product->price
                ],
                'quantity' => $orderItem->quantity,
            ];
        }

        return $lineItems;
    }

    public function subscribeToPaymentEvent(): void
    {
        $this->stripe->webhookEndpoints->create([
           'url' => route('payment.proceed'),
            'enabled_events' => [
                'charge.failed',
                'charge.succeeded'
            ]
        ]);
    }
}
