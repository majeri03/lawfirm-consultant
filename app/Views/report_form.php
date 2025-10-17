<link rel="stylesheet" href="<?= base_url('css/report-form.css') ?>">
<main>
    <section class="report-form-section">
        <div class="container">
            <div class="form-container">
                <div class="form-header">
                    <h1>Formulir Ajuan Bantuan Hukum</h1>
                    <p>Silakan isi formulir di bawah ini untuk menjadwalkan pertemuan dengan tim kami.</p>
                </div>

                 <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?> 
                
                <?php $errors = session()->get('errors'); ?>

                <form action="<?= base_url('/pelajari-layanan/save') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?= old('nama_lengkap') ?>" required>
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
                            <input type="email" name="email" id="email" class="form-control" value="<?= old('email') ?>" required>
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
    </section>
</main>
<script src="<?= base_url('js/wilayah.js') ?>"></script>
<script src="<?= base_url('js/wilayah.js') ?>"></script>

<script> <?php if(session()->getFlashdata('success')): ?> Swal.fire({ title: 'Berhasil Terkirim!', text: "<?= session()->getFlashdata('success') ?>", icon: 'success', confirmButtonText: 'Selesai!',  }); <?php endif; ?> </script>