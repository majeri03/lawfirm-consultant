<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - IWP Law Firm</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css') ?>">
    <style>
        /* Tambahan style khusus untuk halaman profil */
        .profile-card {
            background-color: var(--brand-dark-2);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 2rem;
            max-width: 800px;
            margin: 2rem;
        }
        .profile-card h2 {
            color: var(--brand-gold);
            font-family: 'Lora', serif;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1rem;
        }
        .profile-info-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 1.5rem;
        }
        .profile-info-grid dt {
            font-weight: 500;
            color: var(--text-gray);
        }
        .profile-info-grid dd {
            margin: 0;
            font-size: 1rem;
            color: var(--text-light);
        }
        .profile-info-grid dd {
            word-break: break-word; /* Ini akan memaksa teks pindah baris jika terlalu panjang */
        }
    </style>
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
                <h1>Informasi Profil</h1>
            </header>

            <div class="chat-window">
                <div class="profile-card">
                    <h2>Detail Akun</h2>
                    <dl class="profile-info-grid">
                        <dt>Nama Lengkap</dt>
                        <dd><?= esc($user['nama_lengkap']) ?></dd>

                        <dt>Email</dt>
                        <dd><?= esc($user['email']) ?></dd>

                        <dt>Nomor Handphone</dt>
                        <dd><?= esc($user['nomor_handphone']) ?></dd>

                        <dt>Tanggal Lahir</dt>
                        <dd><?= esc(date('d F Y', strtotime($user['tanggal_lahir']))) ?></dd>

                        <dt>Jenis Kelamin</dt>
                        <dd><?= esc($user['jenis_kelamin']) ?></dd>

                        <dt>Kota/Kabupaten</dt>
                        <dd><?= esc($user['kota']) ?></dd>

                        <dt>Akun Dibuat</dt>
                        <dd><?= esc(date('d F Y, H:i', strtotime($user['created_at']))) ?> WITA</dd>
                    </dl>
                </div>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.querySelector('.sidebar');

            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('open');
                    this.classList.toggle('menu-active'); 
                });
            }
        });
    </script>
</body>
</html>