<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'history' => 'nullable|array',
        ]);

        try {

            $message = trim($request->message);

            /*
            |--------------------------------------------------------------------------
            | Conversation History
            |--------------------------------------------------------------------------
            */

            $history = $request->input('history', []);

            $conversation = '';

            foreach ($history as $chat) {

                $role = $chat['role'] ?? '';
                $content = $chat['content'] ?? '';

                if (!$content) {
                    continue;
                }

                if ($role === 'user') {
                    $conversation .= "Customer: {$content}\n";
                } elseif ($role === 'assistant') {
                    $conversation .= "Smart Food AI: {$content}\n";
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Get approved restaurants + available menu
            |--------------------------------------------------------------------------
            */

            $restaurants = Restaurant::with([
                'menuItems' => function ($query) {
                    $query->where('is_available', true);
                },
                'menuItems.category'
            ])
            ->where('status', 'approved')
            ->get();

            /*
            |--------------------------------------------------------------------------
            | Prepare database data
            |--------------------------------------------------------------------------
            */

            $restaurantData = '';

            foreach ($restaurants as $index => $restaurant) {

                $restaurantData .= "Restaurant #" . ($index + 1) . "\n";

                $restaurantData .= "Restaurant ID: "
                    . $restaurant->id
                    . "\n";

                $restaurantData .= "Name: "
                    . $restaurant->name
                    . "\n";

                $restaurantData .= "Address: "
                    . ($restaurant->address ?? 'Not available')
                    . "\n";

                $restaurantData .= "Phone: "
                    . ($restaurant->phone ?? 'Not available')
                    . "\n";

                $restaurantData .= "Open now: "
                    . ($restaurant->isOpenNow() ? 'Yes' : 'No')
                    . "\n";

                if ($restaurant->menuItems->count() > 0) {

                    $restaurantData .= "Menu:\n";

                    foreach ($restaurant->menuItems as $item) {

                        $restaurantData .= "- Menu Item ID: "
                            . $item->id
                            . "\n";

                        $restaurantData .= "  Name: "
                            . $item->name
                            . "\n";

                        $restaurantData .= "  Price: "
                            . $item->price
                            . "\n";

                        $restaurantData .= "  Category: "
                            . ($item->category->name ?? 'Unknown')
                            . "\n";

                        $restaurantData .= "  Description: "
                            . ($item->description ?? 'No description')
                            . "\n";
                    }

                } else {

                    $restaurantData .=
                        "Menu: No available food currently.\n";
                }

                $restaurantData .= "-------------------------\n";
            }

            /*
            |--------------------------------------------------------------------------
            | Prompt
            |--------------------------------------------------------------------------
            */

            $prompt = <<<PROMPT
You are Smart Food AI.

You are an AI assistant inside the Smart Food restaurant application.

Your job is to help customers find restaurants and available food and help them add food to their cart.

You MUST use ONLY the database information provided below.

DATABASE:

$restaurantData


CONVERSATION HISTORY:

$conversation


CURRENT CUSTOMER MESSAGE:

$message

IMPORTANT RULES:

1. Use the conversation history to understand the meaning of the current customer message.

2. Interpret the current message naturally in the context of previous messages.

3. If the current message depends on something mentioned earlier, use the conversation history to determine what the customer means.

4. Do not require specific words or predefined phrases. Understand natural language from context.

5. Never invent a restaurant.

6. Never invent a food item.

7. Never invent a price.

8. Never invent a menu_item_id.

9. Only use menu items that exist in the database.

10. Only use available menu items.

11. If the customer asks to add food to cart, identify all requested matching menu items.

12. If the customer requests multiple food items, return all of them inside the "items" array.

13. If the customer specifies a quantity for an item, use that quantity.

14. If no quantity is specified for an item, quantity = 1.

15. If any requested food does not exist or is unavailable, do not add that item.

16. If the customer is only asking a question, action must be "none" and items must be an empty array.

17. When action is "add_to_cart", do not claim that the item has already been added to the cart. The actual cart operation is performed by the application.

18. Answer in the same language as the customer.

19. If the customer speaks Egyptian Arabic, use simple Egyptian Arabic.

20. Keep the reply friendly and concise.

21. Return ONLY valid JSON.

The JSON format must be exactly:

{
    "reply": "your natural language response",
    "action": "add_to_cart" or "none",
    "items": [
        {
            "menu_item_name": "exact food name from database",
            "quantity": number
        }
    ]
}

PROMPT;

            /*
            |--------------------------------------------------------------------------
            | Gemini
            |--------------------------------------------------------------------------
            */
$result = null;

for ($attempt = 1; $attempt <= 3; $attempt++) {
    try {
        $result = Gemini::generativeModel(
            model: 'gemini-3.5-flash-lite'
        )->generateContent($prompt);

        break;

    } catch (\Throwable $e) {

        if ($attempt === 3) {
            throw $e;
        }

        sleep(2);
    }
}
          
            $text = trim($result->text());

            /*
            |--------------------------------------------------------------------------
            | Clean possible markdown JSON
            |--------------------------------------------------------------------------
            */

            $text = preg_replace('/```json\s*/i', '', $text);
            $text = preg_replace('/```\s*/', '', $text);

            $data = json_decode(trim($text), true);

            /*
            |--------------------------------------------------------------------------
            | Fallback if Gemini returns invalid JSON
            |--------------------------------------------------------------------------
            */

            if (!is_array($data)) {

                return response()->json([
                    'reply' => $result->text(),
                    'action' => 'none',
                    'items' => [],
                ]);
            }

            return response()->json([
                'reply' => $data['reply'] ?? 'ممكن أوضحلك أكتر؟',
                'action' => $data['action'] ?? 'none',
                'items' => $data['items'] ?? [],
            ]);

        }  catch (\Throwable $e) {

   

    return response()->json([
        'success' => false,
        'message' => 'حدث خطأ أثناء التواصل مع Smart Food AI.',
        'error' => $e->getMessage(),
    ], 500);
}

    }
}