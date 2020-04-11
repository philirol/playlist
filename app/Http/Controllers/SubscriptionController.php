<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Plan;

class SubscriptionController extends Controller
{
    public function create(Request $request, Plan $plan)
    {
        $plan = Plan::findOrFail($request->get('plan'));
        $user = $request->user();
        $paymentMethod = $request->paymentMethod;

        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($paymentMethod);
        $user
            ->newSubscription('main', $plan->stripe_plan)
            ->create($paymentMethod, [
                'email' => $user->email,
        ]);
            
        return redirect('songs')->with('message', __('Merci pour votre abonnement'));
        // return back()->with('message', __('Merci pour votre abonnement'));
    }
}