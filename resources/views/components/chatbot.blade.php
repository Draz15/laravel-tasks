<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            
            {{-- Chat Messages Area --}}
            <div id="chat-box" class="h-96 overflow-y-auto border border-gray-200 p-4 rounded-lg mb-4 bg-gray-50 flex flex-col space-y-3">
                <div class="bg-purple-100 text-purple-900 p-3 rounded-lg max-w-xs self-start">
                    Hi, How Can I help You Today 🎬
                </div>
            </div>

            {{-- Message Form --}}
            <form id="chat-form" class="flex gap-2">
                @csrf
                <input type="text" id="user-input" placeholder="Ask Something..." 
                       class="flex-1 border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3" required>
                
                <button type="submit" id="send-btn" 
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                    Send 
                </button>
            </form>

        </div>
    </div>
</div>

<script>
    document.getElementById('chat-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const input = document.getElementById('user-input');
        const chatBox = document.getElementById('chat-box');
        const sendBtn = document.getElementById('send-btn');
        const message = input.value.trim();

        if (!message) return;

        // 1. Show user message
        appendMessage(message, 'user');
        input.value = '';
        sendBtn.disabled = true;

        // 2. Show loading indicator
        const loadingId = appendLoading();

        try {
            // 3. Send to /chat (aligned with your route name)
            const response = await fetch("{{ route('chat') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();
            removeLoading(loadingId);

            if (data.status === 'success') {
                appendMessage(data.reply, 'bot');
            } else {
                appendMessage(data.reply || 'حدث خطأ أثناء معالجة الطلب.', 'error');
            }

        } catch (error) {
            removeLoading(loadingId);
            appendMessage('تعذر الاتصال بالسيرفر.', 'error');
        } finally {
            sendBtn.disabled = false;
        }
    });

    function appendMessage(text, sender) {
        const chatBox = document.getElementById('chat-box');
        const msgDiv = document.createElement('div');
        
        msgDiv.classList.add('p-3', 'rounded-lg', 'max-w-md', 'break-words');

        if (sender === 'user') {
            msgDiv.classList.add('bg-indigo-600', 'text-white', 'self-end');
        } else if (sender === 'bot') {
            msgDiv.classList.add('bg-gray-200', 'text-gray-800', 'self-start',"bg-purple-100");
        } else {
            msgDiv.classList.add('bg-red-100', 'text-red-700', 'self-start');
        }

        msgDiv.innerText = text;
        chatBox.appendChild(msgDiv);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function appendLoading() {
        const chatBox = document.getElementById('chat-box');
        const loadingDiv = document.createElement('div');
        const id = 'loading-' + Date.now();
        loadingDiv.id = id;
        loadingDiv.classList.add('bg-gray-200', 'text-gray-500', 'p-3', 'rounded-lg', 'max-w-xs', 'self-start', 'italic');
        loadingDiv.innerText = 'Thinking ....';
        chatBox.appendChild(loadingDiv);
        chatBox.scrollTop = chatBox.scrollHeight;
        return id;
    }

    function removeLoading(id) {
        const el = document.getElementById(id);
        if (el) el.remove();
    }
</script>