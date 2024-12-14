<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class PaymobController extends Controller
{
    //

    public function initiateCheckout(Request $request)
    {
        $apiKey = env('PAYMOB_API_KEY');
        $integrationId = env('PAYMOB_INTEGRATION_ID');

        // Step 1: Authenticate with Paymob API
        $authResponse = Http::post('https://accept.paymob.com/api/auth/tokens', [
            'api_key' => $apiKey,
        ]);

        $authToken = $authResponse->json()['token'];

        // Step 2: Create an order
        $orderData = [
            'auth_token' => $authToken,
            'delivery_needed' => false,
            'amount_cents' => $request->input('amount') * 100, // Amount in cents
            'currency' => 'EGP',
            'items' => [],
        ];

        $orderResponse = Http::post('https://accept.paymob.com/api/ecommerce/orders', $orderData);
        $order = $orderResponse->json();

        // Step 3: Generate payment key
        $billingData = [
            'apartment' => 'N/A',
            'email' => $request->input('email'),
            'floor' => 'N/A',
            'first_name' => $request->input('first_name'),
            'street' => 'N/A',
            'building' => 'N/A',
            'phone_number' => $request->input('phone'),
            'shipping_method' => 'PKG',
            'postal_code' => 'N/A',
            'city' => 'Cairo',
            'country' => 'EG',
            'last_name' => $request->input('last_name'),
            'state' => 'N/A',
        ];

        $paymentKeyRequest = [
            'auth_token' => $authToken,
            'amount_cents' => $order['amount_cents'],
            'expiration' => 3600,
            'order_id' => $order['id'],
            'billing_data' => $billingData,
            'currency' => 'EGP',
            'integration_id' => $integrationId,
        ];

        $paymentKeyResponse = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', $paymentKeyRequest);

        $paymentKey = $paymentKeyResponse->json()['token'];

        // Step 4: Redirect to Paymob's hosted checkout page
        return redirect("https://accept.paymob.com/api/acceptance/iframes/{YOUR_IFRAME_ID}?payment_token=$paymentKey");
    }

    public function webhook(Request $request)
    {
        $data = $request->all();

        // Validate and handle the webhook event
        \Log::info('Paymob Webhook Event:', $data);

        // Example: Check if the payment was successful
        if (isset($data['obj']) && $data['obj']['success']) {
            // Update order status in your database
        }

        return response()->json(['status' => 'success']);
    }
}
