<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - IWP Law Firm</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #101010;
            color: #F0F4F8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }
        .dashboard-container {
            padding: 3rem;
            background-color: #1a1a1a;
            border-radius: 12px;
            border: 1px solid #2f2f2f;
        }
        h1 {
            color: #C9A461;
            margin-bottom: 2rem;
        }
        a {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.75rem 1.5rem;
            background-color: #D4AF37;
            color: #101010;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 700;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #e6c55a;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Selamat Datang, <?= esc(session()->get('nama_lengkap')) ?>!</h1>
        <p>Anda telah berhasil login ke sistem.</p>
        <a href="<?= base_url('/logout') ?>">Logout</a>
    </div>
</body>
</html>
