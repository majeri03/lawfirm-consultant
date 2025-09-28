<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Konsultasi - IWP Law Firm</title>
    
    <?= csrf_meta() ?>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css') ?>">
</head>
<body>
    <div class="dashboard-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="<?= base_url('/dashboard') ?>"><img src="<?= base_url('images/logo-iwp-lawfirm-new-white-transparan.png') ?>" alt="IWP Law Firm Logo"></a>
            </div>
    
            <div class="sidebar-content">
                <a href="<?= base_url('/dashboard/profile') ?>" class="user-profile-link">
                    <div class="user-profile">
                        <div class="user-avatar">
                            <?= substr(esc(session()->get('nama_lengkap')), 0, 1) ?>
                        </div>
                        <div class="user-name"><?= esc(session()->get('nama_lengkap')) ?></div>
                        <div class="user-email"><?= esc(session()->get('email')) ?></div>
                    </div>
                </a>
        
                <nav class="nav-menu">
                    <a href="<?= base_url('/dashboard') ?>" class="nav-item active">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                        <span>Konsultasi AI</span>
                    </a>
                    <a href="<?= base_url('/dashboard/profile') ?>" class="nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span>Profil Saya</span>
                    </a>
                    <a href="#" class="nav-item">
                         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <span>Hubungi Kami</span>
                    </a>
                </nav>
            </div>
        
            <div class="sidebar-footer">
                <a href="<?= base_url('/logout') ?>" class="nav-item nav-item-logout">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <main class="main-content">
            <header class="chat-header">
                <button class="menu-toggle" id="menu-toggle" aria-label="Buka Menu">
                    <svg class="icon-open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
                <h1>Asisten Hukum AI</h1>
            </header>

            <div class="chat-window" id="chat-window">
                <div class="chat-message ai-message">
                    <div class="avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    </div>
                    <div class="chat-bubble">
                        Selamat datang di IWP Law Firm. Saya adalah asisten hukum AI Anda. Silakan ajukan pertanyaan hukum Anda. Perlu diingat, jawaban saya bukan merupakan nasihat hukum resmi.
                    </div>
                </div>
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
            
            // Ambil token CSRF dari meta tag yang dibuat oleh `csrf_meta()`
            let csrfToken = document.querySelector('meta[name="X-CSRF-TOKEN"]').getAttribute('content');

            // --- Fungsi untuk Toggle Sidebar ---
            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('open');
                    menuToggle.classList.toggle('menu-active');
                });
            }

            // --- Fungsi Utama Pengiriman Pesan ---
            const handleSendMessage = async () => {
                const userPrompt = chatInput.value.trim();
                if (userPrompt === '') return;

                addMessageToUI(userPrompt, 'user');
                chatInput.value = '';
                addTypingIndicator();

                try {
                    const response = await fetch('<?= base_url('/chatbot/ask') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken // Kirim token di header
                        },
                        body: JSON.stringify({ prompt: userPrompt }) // Kirim data sebagai JSON
                    });

                    removeTypingIndicator();

                    if (!response.ok) {
                        let errorMsg = `HTTP error! status: ${response.status}`;
                        try {
                            const errorData = await response.json();
                            errorMsg = errorData.error || errorData.message || errorMsg;
                        } catch (e) {
                            errorMsg = await response.text();
                        }
                        throw new Error(errorMsg);
                    }

                    const data = await response.json();
                    csrfToken = data.csrf_hash; 
                    addMessageToUI(data.reply, 'ai');

                } catch (error) {
                    console.error('Fetch error:', error);
                    removeTypingIndicator(); 
                    addMessageToUI(`Maaf, terjadi kesalahan: ${error.message}`, 'ai', true);
                }
            };

            // --- Fungsi Helper untuk UI ---
            const addMessageToUI = (message, sender, isError = false) => {
                const messageElement = document.createElement('div');
                messageElement.classList.add('chat-message', `${sender}-message`);

                let avatarHtml = '';
                if (sender === 'ai') {
                    avatarHtml = `<div class="avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></div>`;
                } else {
                    avatarHtml = `<div class="avatar">${userInitial}</div>`;
                }
                
                // Ganti newline (\n) dengan tag <br> agar terbaca di HTML
                const formattedMessage = message.replace(/\n/g, '<br>');

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

            // --- Event Listeners ---
            sendButton.addEventListener('click', handleSendMessage);
            chatInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    handleSendMessage();
                }
            });
        });
    </script>
</body>
</html>