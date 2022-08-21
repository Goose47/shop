<?php

namespace App\Console\Commands;

use App\Services\StripeService;
use Illuminate\Console\Command;

class SubscribeToStripePaymentEventsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribes to stripe payment events using SHOP endpoint';

    /**
     * Stripe service to communicate with Stripe API
     *
     * @var StripeService
     */
    private StripeService $stripeService;

    public function __construct(StripeService $stripeService)
    {
        parent::__construct();
        $this->stripeService = $stripeService;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $this->stripeService->subscribeToPaymentEvent();
        } catch (\Exception $e) {
            $this->info('An error occurred while subscribing: ');
            $this->info($e->getMessage());
            return ;
        }
        $this->info('You have successfully subscribed to Stripe payment events');
    }
}
