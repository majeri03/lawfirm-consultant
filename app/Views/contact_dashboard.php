<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - IWP Law Firm</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css') ?>">
    <style>
        /* Style khusus untuk halaman kontak dashboard */
        .contact-page-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            padding: 2rem;
            height: 100%;
            align-items: center;
        }

        .contact-card-container {
            background-color: var(--brand-dark-2);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 2.5rem;
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        .contact-card-container h2 {
            color: var(--brand-gold);
            font-family: 'Lora', serif;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1rem;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .contact-item .icon {
            flex-shrink: 0;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: var(--brand-dark-3);
            color: var(--brand-gold);
        }
        
        .contact-item .icon svg { width: 22px; height: 22px; }
        .contact-item .details h4 { font-size: 1rem; color: var(--text-gray); margin: 0 0 0.25rem 0; font-weight: 500;}
        .contact-item .details p,
        .contact-item .details a { font-size: 1.1rem; color: var(--text-light); text-decoration: none; margin: 0; }
        .contact-item .details a:hover { color: var(--brand-cream); }
        
        .btn-whatsapp-contact {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            width: 100%;
            justify-content: center;
            background-color: #25D366;
            color: #ffffff;
            padding: 1rem;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            margin-top: 1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-whatsapp-contact:hover { background-color: #128C7E; transform: translateY(-2px); }
        .btn-whatsapp-contact svg { width: 20px; height: 20px; }

        .map-container {
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
            min-height: 500px;
            border: 1px solid var(--border-color);
            animation: fadeIn 1s 0.2s ease-out forwards;
            opacity: 0;
        }
        .map-container iframe { width: 100%; height: 100%; border: 0; filter: grayscale(1) invert(0.9) contrast(0.9); }
        
        @media (max-width: 992px) {
            .contact-page-wrapper { grid-template-columns: 1fr; }
            .map-container { min-height: 300px; height: 40vh; }
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
                <h1>Hubungi Tim Kami</h1>
            </header>

            <div class="chat-window" style="padding:0;">
                <div class="contact-page-wrapper">
                    <div class="contact-card-container">
                        <h2>Informasi Kontak</h2>
                        
                        <div class="contact-item">
                            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></div>
                            <div class="details">
                                <h4>Alamat Kantor</h4>
                                <p>Jl. Benteng Somba Opu, Arrain Residence, Kab. Gowa, Sulawesi Selatan, Indonesia</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></div>
                            <div class="details">
                                <h4>Email</h4>
                                <p><a href="mailto:info@iwplawfirm.com">info@iwplawfirm.com</a></p>
                            </div>
                        </div>

                         <div class="contact-item">
                            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></div>
                            <div class="details">
                                <h4>Jam Operasional</h4>
                                <p>Senin - Jumat: 08:00 - 17:00 WITA</p>
                            </div>
                        </div>

                        <a href="https://wa.me/6282352059054?text=Halo%20IWP%20Law%20Firm,%20saya%20tertarik%20untuk%20berkonsultasi." target="_blank" class="btn-whatsapp-contact">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.8 0-65.7-10.8-94.2-30.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-19.5-31.1-29.9-66.5-29.9-103.3 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                            <span>Mulai Konsultasi via WhatsApp</span>
                        </a>
                    </div>
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.473454366967!2d119.463248315268!3d-5.187313953833939!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee32151859f79%3A0x8686f7badd9036c!2sARRAIN%20RESIDENCE!5e0!3m2!1sid!2sid!4v1695898869818!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Script untuk toggle menu mobile
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