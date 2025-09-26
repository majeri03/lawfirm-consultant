<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - IWP Law Firm</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Lora:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-dark: #101010;
            --brand-gold: #C9A461;
            --brand-cream: #D4AF37;
            --text-light: #F0F4F8;
            --text-gray: #A0AEC0;
            --error-color: #f17b85;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--brand-dark);
            color: var(--text-light);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: radial-gradient(circle at 10% 20%, rgba(201, 164, 97, 0.1) 0%, transparent 50%),
                              radial-gradient(circle at 80% 90%, rgba(212, 175, 55, 0.08) 0%, transparent 40%);
        }
        .auth-container {
            width: 100%;
            max-width: 450px;
            padding: 2.5rem;
            background-color: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: fadeIn 0.8s ease-out;
            margin: 2rem 0;
        }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .auth-header img {
            max-width: 150px;
            margin-bottom: 1rem;
        }
        .auth-header h1 {
            color: var(--brand-gold);
            font-family: 'Lora', serif;
            font-size: 2rem;
        }
        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-gray);
        }
        .form-control, .form-select {
            width: 100%;
            padding: 0.8rem 1rem;
            background-color: #2D3748;
            border: 1px solid #4A5568;
            border-radius: 8px;
            color: var(--text-light);
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: var(--brand-gold);
            box-shadow: 0 0 0 3px rgba(201, 164, 97, 0.3);
        }
        .btn-submit {
            width: 100%;
            padding: 0.9rem;
            background-color: var(--brand-cream);
            border: none;
            border-radius: 8px;
            color: var(--brand-dark);
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-submit:hover { background-color: #e6c55a; transform: translateY(-2px); }
        .auth-switch { text-align: center; margin-top: 1.5rem; color: var(--text-gray); }
        .auth-switch a { color: var(--brand-gold); text-decoration: none; font-weight: 500; }
        .auth-switch a:hover { text-decoration: underline; }
        .register-form { display: none; }
        .error-message {
            color: var(--error-color);
            font-size: 0.8rem;
            margin-top: 0.25rem;
            list-style: none;
        }
        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 8px;
            text-align: center;
            animation: slideDown 0.5s ease-out;
        }
        .alert-success { background-color: rgba(45, 206, 137, 0.2); color: #2dce89; border: 1px solid #2dce89; }
        .alert-error { background-color: rgba(241, 123, 133, 0.2); color: var(--error-color); border: 1px solid var(--error-color); }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .full-width { grid-column: 1 / -1; }
        
        @media (max-width: 500px) {
            .auth-container { padding: 1.5rem; }
            .form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <a href="<?= base_url() ?>"><img src="<?= base_url('images/logo-iwp-lawfirm-new-white-transparan.png') ?>" alt="Logo"></a>
            <h1 id="form-title">Selamat Datang</h1>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        
        <?php $errors = session()->get('errors'); ?>

        <!-- Login Form -->
        <form action="<?= base_url('/login') ?>" method="post" class="login-form">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="login-email">Email</label>
                <input type="email" name="email" id="login-email" class="form-control" value="<?= old('email') ?>" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" name="password" id="login-password" class="form-control" required>
            </div>
            <button type="submit" class="btn-submit">Masuk</button>
            <p class="auth-switch">Belum punya akun? <a href="#" id="show-register">Daftar di sini</a></p>
        </form>

        <!-- Register Form -->
        <form action="<?= base_url('/register') ?>" method="post" class="register-form">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?= old('nama_lengkap') ?>" required>
                 <?php if(isset($errors['nama_lengkap'])): ?><li class="error-message"><?= $errors['nama_lengkap'] ?></li><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="register-email">Email</label>
                <input type="email" name="email" id="register-email" class="form-control" value="<?= old('email') ?>" required>
                 <?php if(isset($errors['email'])): ?><li class="error-message"><?= $errors['email'] ?></li><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="nomor_handphone">Nomor Handphone</label>
                <input type="tel" name="nomor_handphone" id="nomor_handphone" class="form-control" value="<?= old('nomor_handphone') ?>" required>
                 <?php if(isset($errors['nomor_handphone'])): ?><li class="error-message"><?= $errors['nomor_handphone'] ?></li><?php endif; ?>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="register-password">Password</label>
                    <input type="password" name="password" id="register-password" class="form-control" required>
                     <?php if(isset($errors['password'])): ?><li class="error-message"><?= $errors['password'] ?></li><?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="password_confirm">Konfirmasi Password</label>
                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" required>
                </div>
            </div>
             <div class="form-grid">
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= old('tanggal_lahir') ?>" required>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                        <option value="">Pilih...</option>
                        <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
            </div>
             <div class="form-grid">
                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <select name="provinsi" id="provinsi" class="form-select" required>
                        <option value="">Memuat Provinsi...</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kota">Kota/Kabupaten</label>
                    <select name="kota" id="kota" class="form-select" required disabled>
                        <option value="">Pilih Provinsi Dahulu</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-submit">Daftar</button>
            <p class="auth-switch">Sudah punya akun? <a href="#" id="show-login">Masuk di sini</a></p>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.querySelector('.login-form');
            const registerForm = document.querySelector('.register-form');
            const showRegisterLink = document.getElementById('show-register');
            const showLoginLink = document.getElementById('show-login');
            const formTitle = document.getElementById('form-title');

            showRegisterLink.addEventListener('click', (e) => {
                e.preventDefault();
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
                formTitle.textContent = 'Buat Akun Baru';
            });

            showLoginLink.addEventListener('click', (e) => {
                e.preventDefault();
                registerForm.style.display = 'none';
                loginForm.style.display = 'block';
                formTitle.textContent = 'Selamat Datang';
            });

            // API Wilayah Indonesia
            const provinsiSelect = document.getElementById('provinsi');
            const kotaSelect = document.getElementById('kota');

            // Fetch Provinsi
            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                .then(response => response.json())
                .then(provinces => {
                    provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
                    provinces.forEach(provinsi => {
                        const option = document.createElement('option');
                        option.value = provinsi.id;
                        option.textContent = provinsi.name;
                        provinsiSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching provinces:', error);
                    provinsiSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                });

            // Event listener untuk perubahan provinsi
            provinsiSelect.addEventListener('change', function() {
                const provinceId = this.value;
                kotaSelect.innerHTML = '<option value="">Memuat Kota/Kabupaten...</option>';
                kotaSelect.disabled = true;

                if (provinceId) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
                        .then(response => response.json())
                        .then(regencies => {
                            kotaSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                            regencies.forEach(regency => {
                                const option = document.createElement('option');
                                option.value = regency.name;
                                option.textContent = regency.name;
                                kotaSelect.appendChild(option);
                            });
                            kotaSelect.disabled = false;
                        })
                        .catch(error => {
                            console.error('Error fetching regencies:', error);
                            kotaSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                        });
                } else {
                     kotaSelect.innerHTML = '<option value="">Pilih Provinsi Dahulu</option>';
                }
            });
             
             // Check if there are registration errors, then show register form
            <?php if (!empty($errors)): ?>
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
                formTitle.textContent = 'Buat Akun Baru';
            <?php endif; ?>
        });
    </script>
</body>
</html>
