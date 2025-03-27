<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserSubscription;
use App\Models\PaymentHistory;
use Carbon\Carbon;
use Config;
use App\Models\User;

class SubscriptionCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userSubscriptions = UserSubscription::where('status', 'active')->where('end_date', '<=', Carbon::now())->where('payment_for', '<>', 'kit')->get();

        $stripe = new \Stripe\StripeClient(
            Config::get('services.stripe.secret_key')
        );

        foreach ($userSubscriptions as $userSubscription) {
            // dd($userSubscription);
            if ($userSubscription->cancel_date == null) {
                $userSubscription->status = 'inactive';
                if ($userSubscription->cancel_date) {
                    $userSubscription->cancel_date = Carbon::now();
                }
                $userSubscription->update();

                $user = $userSubscription->customer()->first();

                $subscription = $userSubscription->subscription()->first();

                $amount = str_replace(".", "", $subscription->amount) * 100;

                // dd($user);

                try {
                    $charge = $stripe->charges->create(
                        array(
                            "amount" => $amount,
                            "currency" => 'usd',
                            "customer" => $user->stripe_cust_id,
                            "description" => 'Customer: ' . $user->uuid
                        )
                    );
                    \Log::info(print_r($charge, true));

                    if (isset($charge['id'])) {
                        $data['user_id'] = $user->id;
                        $data['amount'] = $subscription->amount;
                        $data['amount_type'] = 'debited';
                        $data['transaction_id'] = $charge['id'];
                        $data['transaction_json'] = json_encode($charge);
                        $data['subscription_id'] = $subscription->id;

                        $data['start_date'] = Carbon::now();

                        if ($subscription->subscription_type == 'monthly') {
                            $data['end_date'] = Carbon::now()->addMonth();
                        }
                        if ($subscription->subscription_type == 'yearly') {
                            $data['end_date'] = Carbon::now()->addYear();
                        }

                        $data['type'] = $subscription->subscription_type;

                        $newSubscription = UserSubscription::create($data);

                        unset($data['transaction_json']);
                        $data['subscription_id'] = $newSubscription['id'];

                        PaymentHistory::create($data);

                    }
                } catch (\Throwable $th) {
                    \Log::info($th->getMessage());
                    continue;
                }


            } else {
                $userSubscription->status = 'inactive';

                if (!$userSubscription->cancel_date) {
                    $userSubscription->cancel_date = Carbon::now();
                }

                $userSubscription->update();

                User::where('id', $userSubscription->user_id)->update([
                    'is_subscription' => 0,
                    'is_subscription_recurring' => 0
                ]);
            }
        }

        return Command::SUCCESS;

    }
}
