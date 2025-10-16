<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IWP - Advokat & Konsultan Hukum</title>

    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/sections/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/sections/trust-logos.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/sections/about.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/sections/practice-areas.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/sections/team.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/sections/testimonials.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/sections/contact.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/sections/footer.css') ?>">

    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="#hero" class="navbar-logo">
                <img src="<?= base_url('images/logo-iwp-lawfirm-new-white-transparan.png') ?>" alt="IWP Law Firm" />
            </a>
            <div class="nav-links">
                <a href="#hero">Beranda</a>
                <a href="#about">Tentang Kami</a>
                <a href="#practice-areas">Area Praktik</a>
                <a href="#team">Tim Kami</a>
                <a href="#testimonials">Testimoni</a>
                <a href="https://legalife.iwplawfirm.com" target="_blank"><b>Blog</b></a>
                <a href="#contact">Kontak</a>
            </div>
            <div class="navbar-cta">
                <a href="<?= base_url('/login') ?>" class="cta-button">
                    <span>Masuk / Daftar</span>
                </a>
            </div>
            <div class="hamburger-menu">
                <svg class="icon-hamburger" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="24" height="24"><path fill="currentColor" d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="24" height="24"><path fill="currentColor" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
            </div>
        </div>
    </nav>