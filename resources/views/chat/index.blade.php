
<x-app-layout>

    <style>

        .chat-page {
            max-width: 900px;
            margin: auto;
            padding: 40px 20px 80px;
        }

        .chat-box {
            background: white;
            border-radius: 22px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .08);
            overflow: hidden;
            border: 1px solid #eee;
        }

        /* Header */

        .chat-header {
            background: linear-gradient(135deg, #ff5722, #ff7043);
            color: white;
            padding: 25px;
        }

        .chat-header h1 {
            margin: 0 0 5px;
            font-size: 24px;
        }

        .chat-header p {
            margin: 0;
            opacity: .9;
            font-size: 14px;
        }


        /* Messages */

        .chat-messages {
            height: 500px;
            overflow-y: auto;
            padding: 25px;
            background: #fafafa;
        }

        .message {
            display: flex;
            margin-bottom: 18px;
        }

        .message.user {
            justify-content: flex-end;
        }

        .message.ai {
            justify-content: flex-start;
        }

        .message-content {
            max-width: 70%;
            padding: 12px 16px;
            border-radius: 16px;
            line-height: 1.6;
            font-size: 14px;
            word-break: break-word;
        }

        .user .message-content {
            background: #ff5722;
            color: white;
            border-bottom-right-radius: 4px;
        }

        .ai .message-content {
            background: white;
            color: #333;
            border: 1px solid #eee;
            border-bottom-left-radius: 4px;
        }


        /* Input */

        .chat-input-area {
            padding: 18px;
            border-top: 1px solid #eee;
            background: white;
        }

        .chat-form {
            display: flex;
            gap: 10px;
        }

        .chat-form input {
            flex: 1;

            border: 1px solid #ddd;
            border-radius: 12px;

            padding: 13px 15px;

            outline: none;

            font-size: 14px;
        }

        .chat-form input:focus {
            border-color: #ff5722;
        }

        .send-btn {
            border: none;

            background: #ff5722;
            color: white;

            padding: 0 22px;

            border-radius: 12px;

            cursor: pointer;

            font-weight: 600;

            transition: .2s;
        }

        .send-btn:hover {
            background: #e64a19;
        }

        .send-btn:disabled {
            opacity: .6;
            cursor: not-allowed;
        }


        /* Typing */

        .typing {
            color: #888;

            font-size: 13px;

            display: none;

            margin-top: 10px;
        }


        /* Responsive */

        @media(max-width: 600px) {

            .chat-page {
                padding: 25px 15px 50px;
            }

            .chat-messages {
                height: 450px;
            }

            .message-content {
                max-width: 85%;
            }

            .chat-form {
                flex-direction: column;
            }

            .send-btn {
                padding: 12px;
            }

        }

    </style>


    <div class="chat-page">

        <div class="chat-box">


            {{-- Header --}}

            <div class="chat-header">

                <h1>
                    🤖 Smart Food AI
                </h1>

                <p>
                    Ask me about meals, restaurants, and food recommendations.
                </p>

            </div>


            {{-- Messages --}}

            <div
                class="chat-messages"
                id="chatMessages"
            >

                {{-- First AI Message --}}

                <div class="message ai">

                    <div class="message-content">

                        👋 Hi! I'm Smart Food AI.<br>

                        How can I help you today?

                    </div>

                </div>

            </div>


            {{-- Input Area --}}

            <div class="chat-input-area">

                <form
                    id="chatForm"
                    class="chat-form"
                    onsubmit="sendMessage(event)"
                >

                    @csrf

                    <input
                        type="text"
                        id="messageInput"
                        placeholder="Ask me about food..."
                        autocomplete="off"
                    >

                    <button
                        type="submit"
                        class="send-btn"
                        id="sendButton"
                    >
                        Send
                    </button>

                </form>


                <div
                    class="typing"
                    id="typing"
                >
                    🤖 Smart Food AI is thinking...
                </div>

            </div>

        </div>

    </div>
   

<script>

    // Store the conversation so AI can understand previous messages
    let conversationHistory = [];


    async function sendMessage(event) {

        event.preventDefault();

        const input =
            document.getElementById('messageInput');

        const messages =
            document.getElementById('chatMessages');

        const button =
            document.getElementById('sendButton');

        const typing =
            document.getElementById('typing');

        const message =
            input.value.trim();

        if (!message) {
            return;
        }


        /*
         * Show user's message
         */

        messages.innerHTML += `

            <div class="message user">

                <div class="message-content">

                    ${escapeHtml(message)}

                </div>

            </div>

        `;

        input.value = '';

        messages.scrollTop =
            messages.scrollHeight;

        button.disabled = true;

        typing.style.display = 'block';


        /*
         * Save user's message BEFORE sending it
         */

        conversationHistory.push({
            role: 'user',
            content: message
        });


        try {

            /*
             * Send message + conversation history to AI
             */

            const response = await fetch(
                "{{ route('chat.send') }}",
                {
                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },

                    body: JSON.stringify({

                        message: message,

                        history: conversationHistory

                    })
                }
            );


            const data =
                await response.json();


            /*
             * Check error
             */

            if (!response.ok) {

                throw new Error(
                    data.message ||
                    'Something went wrong.'
                );
            }


            /*
             * Save AI reply in conversation history
             */

            conversationHistory.push({
                role: 'assistant',
                content: data.reply
            });


            /*
             * Show AI reply
             */

            messages.innerHTML += `

                <div class="message ai">

                    <div class="message-content">

                        ${escapeHtml(data.reply)}

                    </div>

                </div>

            `;


            /*
             |--------------------------------------------------------------------------
             | Add items to cart if AI requested it
             |--------------------------------------------------------------------------
             */

            if (
                data.action === 'add_to_cart' &&
                Array.isArray(data.items) &&
                data.items.length > 0
            ) {

                try {

                    const cartResponse = await fetch(
                        "{{ route('cart.ai.add') }}",
                        {
                            method: "POST",

                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },

                            body: JSON.stringify({

                                items: data.items

                            })
                        }
                    );


                    const cartData =
                        await cartResponse.json();


                    /*
                     * If Laravel rejected the items
                     */

                   if (!cartResponse.ok) {

    console.error('Cart Error:', cartData);

    throw new Error(
        cartData.error ||
        cartData.message ||
        'Could not add items to cart.'
    );
}

                    /*
                     * Show cart result
                     */

                    messages.innerHTML += `

                        <div class="message ai">

                            <div class="message-content">

                                ${escapeHtml(cartData.message)}

                                <br><br>

                                🛒 <a
                                    href="{{ route('cart.index') }}"
                                    style="
                                        color:#ff5722;
                                        font-weight:600;
                                        text-decoration:none;
                                    "
                                >
                                    View Cart
                                </a>

                            </div>

                        </div>

                    `;


                } catch (cartError) {

                    messages.innerHTML += `

                        <div class="message ai">

                            <div class="message-content">

                                ❌ ${escapeHtml(cartError.message)}

                            </div>

                        </div>

                    `;

                    console.error(cartError);
                }
            }


        } catch (error) {

            messages.innerHTML += `

                <div class="message ai">

                    <div class="message-content">

                        ❌ ${escapeHtml(error.message)}

                    </div>

                </div>

            `;

            console.error(error);


        } finally {

            button.disabled = false;

            typing.style.display = 'none';

            messages.scrollTop =
                messages.scrollHeight;

            input.focus();
        }
    }


    /*
     * Prevent HTML injection
     */

    function escapeHtml(text) {

        const div =
            document.createElement('div');

        div.textContent = text;

        return div.innerHTML;
    }

</script>




   

</x-app-layout>

