<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PayPalService
{
    private function baseUrl(): string
    {
        return rtrim(config('services.paypal.base_url'), '/');
    }

    public function getAccessToken(): string
    {
        $response = Http::asForm()
            ->withBasicAuth(
                config('services.paypal.client_id'),
                config('services.paypal.client_secret')
            )
            ->post(
                $this->baseUrl() . '/v1/oauth2/token',
                [
                    'grant_type' => 'client_credentials',
                ]
            );

        $response->throw();

        return $response->json('access_token');
    }

  public function createOrder(float $amount): array
{
    $accessToken = $this->getAccessToken();

    // Convert EGP to USD for PayPal
    $rate = (float) env('PAYPAL_EGP_TO_USD_RATE', 50);

$usdAmount = $amount / $rate;
    $response = Http::withToken($accessToken)
        ->acceptJson()
        ->post(
            $this->baseUrl() . '/v2/checkout/orders',
            [
                'intent' => 'CAPTURE',

                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' => number_format(
                                $usdAmount,
                                2,
                                '.',
                                ''
                            ),
                        ],
                    ],
                ],

                'application_context' => [
                    'brand_name' => 'Smart Food',
                    'landing_page' => 'LOGIN',
                    'user_action' => 'PAY_NOW',

                    'return_url' => route(
                        'payment.success'
                    ),

                    'cancel_url' => route(
                        'payment.cancel'
                    ),
                ],
            ]
        );

    $response->throw();

    return $response->json();
}



public function captureOrder(string $orderId): array
{
    $accessToken = $this->getAccessToken();

    $url = $this->baseUrl()
        . "/v2/checkout/orders/{$orderId}/capture";

    $response = Http::withToken($accessToken)
        ->acceptJson()
        ->withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->send('POST', $url, [
            'body' => '{}',
        ]);

    if ($response->failed()) {
        throw new \Exception(
            'Failed to capture PayPal order: '
            . $response->body()
        );
    }

    return $response->json();
}

    public function getOrder(string $orderId): array
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
            ->acceptJson()
            ->get(
                $this->baseUrl()
                . "/v2/checkout/orders/{$orderId}"
            );

        $response->throw();

        return $response->json();
    }
}