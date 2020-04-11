<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;

class PaiementController extends Controller
{
    function formulaire() {

        return view ('formulairePaiement');
      
      }

    function paiementOK(){
        return redirect('songs')->with('message', 'Paiement effectué. merci !');
    } 

    function process(Request $request) { 

   
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        header('Content-Type: application/json');
    
    
    
        # retrieve json from POST body
    
        $json_str = file_get_contents('php://input');
    
        $json_obj = json_decode($json_str);
    
    
    
        $intent = null;
    
        try {
    
            if (isset($json_obj->payment_method_id)) {
    
                # Create the PaymentIntent
    
                $intent = \Stripe\PaymentIntent::create([
    
                    'payment_method' => $json_obj->payment_method_id,
    
                    'confirmation_method' => 'manual',
    
                    'confirm' => true,
    
                    'amount'   => 5000,
    
                    'currency' => 'eur',
    
                    'description' => "Mon paiement"
    
                ]);
    
            }
    
            if (isset($json_obj->payment_intent_id)) {
    
                $intent = \Stripe\PaymentIntent::retrieve(
    
                    $json_obj->payment_intent_id
    
                );
    
                $intent->confirm();
    
            }
    
            if ($intent->status == 'requires_action' &&
    
                $intent->next_action->type == 'use_stripe_sdk') {
    
                # Tell the client to handle the action
    
                echo json_encode([
    
                    'requires_action' => true,
    
                    'payment_intent_client_secret' => $intent->client_secret
    
                ]);
    
            } else if ($intent->status == 'succeeded') {
    
                // Paiement Stripe accepté
    
    
    
                echo json_encode([
    
                    "success" => true
    
                ]);
    
            } else {
    
                http_response_code(500);
    
                echo json_encode(['error' => 'Invalid PaymentIntent status']);
    
            }
    
        } catch (\Exception $e) {
    
            # Display error on client
    
            echo json_encode([
    
                'error' => $e->getMessage()
    
            ]);
    
        }
    
    }
}
