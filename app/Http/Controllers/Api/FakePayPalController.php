<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FakePayPalController extends Controller
{
    public function pay(Request $request)
    {
        $request->validate([
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],
            'currency' => [
                'required',
                'string',
            ],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment successful',
            'transaction_id' => 'PAYPAL-FAKE-' . strtoupper(Str::random(10)),
            'amount' => $request->amount,
            'currency' => $request->currency,
        ]);
    }
}