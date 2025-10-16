<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Konsultasi - IWP Law Firm</title>
    
    <?= csrf_meta() ?>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
</head>
<body>
    <div class="dashboard-wrapper">
        <?= $this->include('templates/sidebar') ?>

        <main class="main-content">
             <header class="chat-header">
                <button class="menu-toggle" id="menu-toggle" aria-label="Buka Menu">
                    <svg class="icon-open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
                <h1>Asisten Hukum AI</h1>
                <a href="#" id="clear-chat-button" class="clear-chat-btn" title="Hapus Percakapan">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </a>
            </header>

            <div class="chat-window" id="chat-window">
                </div>

            <footer class="chat-input-area">
                <div class="input-wrapper">
                    <input type="text" id="chat-input" placeholder="Ketik pertanyaan Anda di sini..." autocomplete="off">
                    <button id="send-button" aria-label="Kirim Pesan">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    </button>
                </div>
            </footer>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // --- Variabel Global ---
        const chatWindow = document.getElementById('chat-window');
        const chatInput = document.getElementById('chat-input');
        const sendButton = document.getElementById('send-button');
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const userInitial = "<?= substr(esc(session()->get('nama_lengkap')), 0, 1) ?>";
        const storageKey = `chatHistory-<?= session()->get('user_id') ?>`;
        const clearChatButton = document.getElementById('clear-chat-button');
        let csrfToken = document.querySelector('meta[name="X-CSRF-TOKEN"]').getAttribute('content');
        let conversationHistory = []; // Variabel untuk menyimpan riwayat chat

        // --- Fungsi untuk menyimpan percakapan ke localStorage ---
        const saveConversation = () => {
            localStorage.setItem(storageKey, JSON.stringify(conversationHistory));
        };

        // --- EVENT LISTENER UNTUK TOMBOL HAPUS PERCAKAPAN ---
        if (clearChatButton) {
            clearChatButton.addEventListener('click', function(e) {
                e.preventDefault(); // Mencegah link berpindah halaman

                if (confirm('Apakah Anda yakin ingin menghapus riwayat percakapan ini?')) {
                    localStorage.removeItem(storageKey);
                    conversationHistory = [];
                    chatWindow.innerHTML = '';
                    addWelcomeMessage();
                }
            });
        }
        // --- Fungsi untuk memuat percakapan dari localStorage ---
        const loadConversation = () => {
            const savedHistory = localStorage.getItem(storageKey);
            
            // Hapus semua elemen anak dari chatWindow
            while (chatWindow.firstChild) {
                chatWindow.removeChild(chatWindow.firstChild);
            }

            if (savedHistory && JSON.parse(savedHistory).length > 0) {
                conversationHistory = JSON.parse(savedHistory);
                conversationHistory.forEach(item => {
                    if (item.type === 'limit') {
                        addLimitMessageToUI();
                    } else {
                        addMessageToUI(item.message, item.sender, item.isError || false);
                    }
                });
            } else {
                // Jika tidak ada riwayat, tampilkan pesan selamat datang dan saran
                conversationHistory = []; // Pastikan history kosong jika tidak ada data
                addWelcomeMessage();
            }
        };
        
        // --- Fungsi untuk menampilkan pesan selamat datang & saran ---
        const addWelcomeMessage = () => {
            const welcomeHTML = `
                <div class="chat-message ai-message">
                    <div class="avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    </div>
                    <div class="chat-bubble">
                        Selamat datang di IWP Law Firm. Saya adalah asisten hukum AI Anda. Silakan ajukan pertanyaan hukum Anda. Perlu diingat, jawaban saya bukan merupakan nasihat hukum resmi.
                    </div>
                </div>
                <div class="suggested-prompts" id="suggested-prompts">
                    <button class="prompt-suggestion">Apa saja syarat sahnya perjanjian?</button>
                    <button class="prompt-suggestion">Bagaimana proses penyelesaian sengketa tanah?</button>
                    <button class="prompt-suggestion">Jelaskan tentang hukum waris di Indonesia.</button>
                    <button class="prompt-suggestion">Apa saja hak-hak pekerja menurut UU Cipta Kerja?</button>
                    <button class="prompt-suggestion">Bagaimana prosedur mendirikan PT Perorangan?</button>
                </div>`;
            chatWindow.insertAdjacentHTML('beforeend', welcomeHTML);

            // Tambahkan event listener lagi ke tombol saran yang baru dibuat
            document.querySelectorAll('.prompt-suggestion').forEach(button => {
                button.addEventListener('click', handleSuggestionClick);
            });
        };

        if (menuToggle && sidebar) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                menuToggle.classList.toggle('menu-active');
            });
        }

        const handleSuggestionClick = (e) => {
            chatInput.value = e.target.textContent;
            handleSendMessage();
        };

        const handleSendMessage = async () => {
            const userPrompt = chatInput.value.trim();
            if (userPrompt === '') return;

            const suggestedPromptsContainer = document.getElementById('suggested-prompts');
            if (suggestedPromptsContainer) {
                // Hapus kontainer saran
                suggestedPromptsContainer.remove();
            }

            addMessageToUI(userPrompt, 'user');
            conversationHistory.push({ sender: 'user', message: userPrompt });
            saveConversation();

            chatInput.value = '';
            addTypingIndicator();

            try {
                const response = await fetch('<?= base_url('/chatbot/ask') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ prompt: userPrompt })
                });

                removeTypingIndicator();

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.error || `HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                csrfToken = data.csrf_hash;
                
                if (data.status === 'limit_reached') {
                    addLimitMessageToUI();
                    conversationHistory.push({ type: 'limit' });
                } else if (data.status === 'success') {
                    addMessageToUI(data.reply, 'ai');
                    conversationHistory.push({ sender: 'ai', message: data.reply });
                } else {
                    const errorMessage = 'Terjadi respons yang tidak terduga dari server.';
                    addMessageToUI(errorMessage, 'ai', true);
                    conversationHistory.push({ sender: 'ai', message: errorMessage, isError: true });
                }
                saveConversation();
                
            } catch (error) {
                console.error('Fetch error:', error);
                removeTypingIndicator(); 
                
                let errorMessage = `Maaf, terjadi kesalahan: ${error.message}.`;
            
             
                if (error.message.includes('403')) {
                    errorMessage = 'Sesi keamanan Anda tidak sinkron. Silakan segarkan (refresh) halaman ini untuk melanjutkan.';
                }
            
                addMessageToUI(errorMessage, 'ai', true);
                conversationHistory.push({ sender: 'ai', message: errorMessage, isError: true });
                saveConversation();
            }
        };
        
        const addMessageToUI = (message, sender, isError = false) => {
            const messageElement = document.createElement('div');
            messageElement.classList.add('chat-message', `${sender}-message`);

            let avatarHtml = '';
            if (sender === 'ai') {
                avatarHtml = `<div class="avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></div>`;
            } else {
                avatarHtml = `<div class="avatar">${userInitial}</div>`;
            }
            
            const formattedMessage = marked.parse(message);

            messageElement.innerHTML = `
                ${avatarHtml}
                <div class="chat-bubble">${formattedMessage}</div>
            `;

            if(isError) {
                messageElement.querySelector('.chat-bubble').style.backgroundColor = '#e53e3e';
            }

            chatWindow.appendChild(messageElement);
            chatWindow.scrollTop = chatWindow.scrollHeight;
        };
        
        const addLimitMessageToUI = () => {
            const messageElement = document.createElement('div');
            messageElement.classList.add('chat-message', 'ai-message');

            const messageContent = `
                <div class="avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <div class="chat-bubble">
                    Pertanyaan Anda membutuhkan analisis yang lebih mendalam. Untuk mendapatkan jawaban yang komprehensif, silakan lanjutkan konsultasi langsung dengan tim hukum kami.
                    <a href="https://wa.me/6282352059054?text=Halo%20IWP%20Law%20Firm,%20saya%20ingin%20melanjutkan%20konsultasi%20dari%20Asisten%20AI." target="_blank" class="whatsapp-button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="18" height="18"><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.8 0-65.7-10.8-94.2-30.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-19.5-31.1-29.9-66.5-29.9-103.3 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                        <span>Lanjut via WhatsApp</span>
                    </a>
                </div>
            `;
            messageElement.innerHTML = messageContent;
            chatWindow.appendChild(messageElement);
            chatWindow.scrollTop = chatWindow.scrollHeight;
        };

        const addTypingIndicator = () => {
            const typingElement = document.createElement('div');
            typingElement.id = 'typing-indicator';
            typingElement.classList.add('chat-message', 'ai-message');
            typingElement.innerHTML = `
                <div class="avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <div class="chat-bubble">
                    <span>.</span><span>.</span><span>.</span>
                </div>
            `;
            chatWindow.appendChild(typingElement);
            chatWindow.scrollTop = chatWindow.scrollHeight;
        };

        const removeTypingIndicator = () => {
            const typingIndicator = document.getElementById('typing-indicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
        };

        sendButton.addEventListener('click', handleSendMessage);
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                handleSendMessage();
            }
        });

        // --- Panggil fungsi untuk memuat percakapan saat halaman dimuat ---
        loadConversation();
    });
    </script>
</body>
</html>