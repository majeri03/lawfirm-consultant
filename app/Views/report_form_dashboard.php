<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Bantuan Hukum - IWP Law Firm</title>
    <?= csrf_meta() ?>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/report-form.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <h1>Ajukan Bantuan Hukum</h1>
            </header>

            <div class="chat-window">
                <div class="form-container" > 

                    <?php $errors = session()->get('errors'); ?>

                    <form action="<?= base_url('/pelajari-layanan/save') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?= old('nama_lengkap', session()->get('nama_lengkap')) ?>" required>
                                <?php if(isset($errors['nama_lengkap'])): ?><div class="error-message"><?= $errors['nama_lengkap'] ?></div><?php endif; ?>
                            </div>

                            <div class="form-group full-width">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="3" required><?= old('alamat') ?></textarea>
                                <?php if(isset($errors['alamat'])): ?><div class="error-message"><?= $errors['alamat'] ?></div><?php endif; ?>
                            </div>

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

                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="form-select" required disabled>
                                    <option value="">Pilih Kota Dahulu</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kelurahan">Kelurahan</label>
                                <select name="kelurahan" id="kelurahan" class="form-select" required disabled>
                                    <option value="">Pilih Kecamatan Dahulu</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="no_hp">No. HP/WA</label>
                                <input type="tel" name="no_hp" id="no_hp" class="form-control" value="<?= old('no_hp') ?>" required>
                                <?php if(isset($errors['no_hp'])): ?><div class="error-message"><?= $errors['no_hp'] ?></div><?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= old('email', session()->get('email')) ?>" required>
                                 <?php if(isset($errors['email'])): ?><div class="error-message"><?= $errors['email'] ?></div><?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="jenis_layanan">Jenis Layanan</label>
                                <select name="jenis_layanan" id="jenis_layanan" class="form-select" required>
                                    <option value="">Pilih Jenis Layanan</option>
                                    <option value="Bantuan Pendirian Perusahaan">Bantuan Pendirian Perusahaan</option>
                                    <option value="Merger / Akuisisi Perusahaan">Merger / Akuisisi Perusahaan</option>
                                    <option value="Sengketa Perdata">Sengketa Perdata</option>
                                    <option value="Sengketa Pidana">Sengketa Pidana</option>
                                    <option value="Sengketa Tanah">Sengketa Tanah</option>
                                    <option value="Sewa-Menyewa">Sewa-Menyewa</option>
                                    <option value="Perceraian">Perceraian</option>
                                    <option value="Hak Asuh Anak">Hak Asuh Anak</option>
                                    <option value="Waris">Waris</option>
                                    <option value="Adopsi">Adopsi</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jadwal_pertemuan">Jadwal Pertemuan Pertama</label>
                                <input type="date" name="jadwal_pertemuan" id="jadwal_pertemuan" class="form-control" value="<?= old('jadwal_pertemuan') ?>" required>
                            </div>

                            <div class="form-group full-width">
                                <label for="deskripsi_kasus">Jelaskan Secara Singkat Kasus Hukum Anda</label>
                                <textarea name="deskripsi_kasus" id="deskripsi_kasus" class="form-control" rows="5" required><?= old('deskripsi_kasus') ?></textarea>
                                <?php if(isset($errors['deskripsi_kasus'])): ?><div class="error-message"><?= $errors['deskripsi_kasus'] ?></div><?php endif; ?>
                            </div>
                        </div>

                        <button type="submit" class="btn-submit">Kirim Laporan</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="<?= base_url('js/wilayah.js') ?>"></script>
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
        <?php if(session()->getFlashdata('success')): ?>
            Swal.fire({
                title: 'Berhasil Terkirim!',
                text: "<?= session()->getFlashdata('success') ?>",
                icon: 'success',
                confirmButtonText: 'Selesai!'
            });
        <?php endif; ?>
    </script>
</body>
</html>