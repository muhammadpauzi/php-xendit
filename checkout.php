<?php
require "bootstrap.php";

$product_id = $_GET['product_id'];

$product = $products[$product_id - 1];

switch ($_GET['using']) {
    case 'dana':
        $ewalletChargeParams = [
            'reference_id' => 'test-reference-id-' . time(),
            'currency' => 'IDR',
            'amount' => $product['price'],
            'checkout_method' => 'ONE_TIME_PAYMENT',
            'channel_code' => 'ID_DANA',
            'channel_properties' => [
                'success_redirect_url' => 'http://localhost:1234',
            ],
            'metadata' => [
                'branch_code' => 'tree_branch'
            ]
        ];

        $createEWalletCharge = \Xendit\EWallets::createEWalletCharge($ewalletChargeParams);
        header("location: " . $createEWalletCharge['actions']['desktop_web_checkout_url']);
        break;

    case 'invoice':
        $params = [
            'external_id' => 'demo_1475801962607',
            'amount' => $product['price'],
            'description' => 'Invoice Demo #123',
            'invoice_duration' => 86400,
            'customer' => [
                'given_names' => 'John',
                'surname' => 'Doe',
                'email' => 'johndoe@example.com',
                'mobile_number' => '+6287774441111',
                'addresses' => [
                    [
                        'city' => 'Jakarta Selatan',
                        'country' => 'Indonesia',
                        'postal_code' => '12345',
                        'state' => 'Daerah Khusus Ibukota Jakarta',
                        'street_line1' => 'Jalan Makan',
                        'street_line2' => 'Kecamatan Kebayoran Baru'
                    ]
                ]
            ],
            'customer_notification_preference' => [
                'invoice_created' => [
                    'whatsapp',
                    'sms',
                    'email',
                    'viber'
                ],
                'invoice_reminder' => [
                    'whatsapp',
                    'sms',
                    'email',
                    'viber'
                ],
                'invoice_paid' => [
                    'whatsapp',
                    'sms',
                    'email',
                    'viber'
                ],
                'invoice_expired' => [
                    'whatsapp',
                    'sms',
                    'email',
                    'viber'
                ]
            ],
            'success_redirect_url' => 'http://localhost:1234',
            'failure_redirect_url' => 'http://localhost:1234',
            'currency' => 'IDR',
            'items' => [
                [
                    'name' => $product['name'],
                    'quantity' => 1,
                    'price' => $product['price'],
                    'category' => 'Electronic',
                    'url' => 'http://localhost:1234'
                ]
            ],
            'fees' => [
                [
                    'type' => 'ADMIN',
                    'value' => 5000
                ]
            ]
        ];

        $createInvoice = \Xendit\Invoice::create($params);
        header('location: ' . $createInvoice['invoice_url']);
        break;

    default:
        # code...
        break;
}


?>