<?php

namespace App\Services;

use MG\Paymob\Paymob;

class PaymobService
{
    public static function checkout($orderItems, $billingData)
    {
        // Prepare order items
        $orderItems = [
            [
                'name'         => 'Product x',
                'amount_cents' => 100,
                'description'  => 'Product description',
                'quantity'     => 1
            ]
        ];

        // Prepare billing data: Fill empty keys with 'N/A'; required!
        $billingData = [
            'first_name'      => 'John',
            'last_name'       => 'Doe',
            'email'           => 'someone@example.com',
            'phone_number'    => '+1xxxxxxxx',
            'apartment'       => 'N/A',
            'floor'           => 'N/A',
            'building'        => 'N/A',
            'street'          => 'N/A',
            'city'            => 'N/A',
            'shipping_method' => 'N/A',
            'country'         => 'N/A',
            'state'           => 'N/A',
        ];

        // Prepare order itself
        $orderToPrepare['amount_cents']      = 10;
        $orderToPrepare['merchant_order_id'] = 101;
        $orderToPrepare['items']             = $orderItems;
        $orderToPrepare['billing_data']      = $billingData;
        $item = new Paymob();
        // Get payment URL
        $paymentUrl = $item->makePayment($orderToPrepare);

        return $paymentUrl;
    }
}
