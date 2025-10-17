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
            <a href="<?= base_url('/dashboard') ?>" class="nav-item <?= (uri_string() == 'dashboard') ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                <span>Konsultasi AI</span>
            </a>
            <a href="<?= base_url('/dashboard/report') ?>" class="nav-item <?= (uri_string() == 'dashboard/report') ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                <span>Ajukan Bantuan Hukum</span>
            </a>
            <a href="<?= base_url('/dashboard/profile') ?>" class="nav-item <?= (uri_string() == 'dashboard/profile') ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <span>Profil Saya</span>
            </a>
            <a href="<?= base_url('/dashboard/contact') ?>" class="nav-item <?= (uri_string() == 'dashboard/contact') ? 'active' : '' ?>">
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