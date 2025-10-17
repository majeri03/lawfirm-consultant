<aside class="admin-sidebar" id="admin-sidebar">
    <div class="admin-sidebar-header">
        <a href="<?= base_url('/admin') ?>">
            <img src="<?= base_url('images/logo-iwp-lawfirm-new-white-transparan.png') ?>" alt="IWP Law Firm Logo">
        </a>
    </div>

    <nav class="admin-nav-menu">
        <a href="<?= base_url('/admin') ?>" class="nav-item <?= (uri_string() == 'admin') ? 'active' : '' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
            <span>Dashboard</span>
        </a>
        <a href="<?= base_url('/logout') ?>" class="nav-item">
             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            <span>Logout</span>
        </a>
    </nav>
</aside>