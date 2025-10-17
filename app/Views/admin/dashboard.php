<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - IWP Law Firm</title>
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="admin-container">
        <?= $this->include('templates/admin/sidebar') ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <button class="menu-toggle" id="menu-toggle" aria-label="Buka Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </button>
                <h1>Laporan Klien Masuk</h1>
            </header>

            <div class="content-wrapper">
                <div class="content-card">
                    <div class="table-responsive-wrapper">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Klien</th>
                                    <th>Jenis Layanan</th>
                                    <th>Jadwal Pertemuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6" style="text-align: center;">Memuat data...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="modal-backdrop" id="view-detail-modal">
        <div class="modal-content">
            <header class="modal-header">
                <h2>Detail Laporan Klien</h2>
                <button class="modal-close-btn" id="modal-close-button">&times;</button>
            </header>
            <div class="modal-body" id="modal-body-content">
                <p>Memuat detail...</p>
            </div>
            <footer class="modal-footer">
                <form id="status-update-form" class="status-update-form">
                    <input type="hidden" name="report_id" id="report_id_input">
                    <label for="status-select">Ubah Status:</label>
                    <select name="status" id="status-select" class="status-select">
                        <option value="Baru Masuk">Baru Masuk</option>
                        <option value="Sudah Dihubungi">Sudah Dihubungi</option>
                        <option value="Jadwal Ulang">Jadwal Ulang</option>
                        <option value="Kasus Diterima">Kasus Diterima</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                    <button type="submit" class="btn-update-status">Simpan</button>
                </form>
            </footer>
        </div>
    </div>
    
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // --- Kumpulan Variabel Elemen ---
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('admin-sidebar');
        const tableBody = document.querySelector('.modern-table tbody');
        const modal = document.getElementById('view-detail-modal');
        const modalBody = document.getElementById('modal-body-content');
        const modalCloseBtn = document.getElementById('modal-close-button');
        const statusForm = document.getElementById('status-update-form');
        const statusSelect = document.getElementById('status-select');
        const reportIdInput = document.getElementById('report_id_input');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // --- Logika Sidebar ---
        if (menuToggle && sidebar) {
            menuToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
        }

        // --- Fungsi Utama: Ambil Data dan Bangun Tabel ---
        const fetchReports = async () => {
            try {
                const response = await fetch('<?= base_url('/admin/reports') ?>', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                const reports = await response.json();
                
                tableBody.innerHTML = ''; // Bersihkan tabel
                if (reports.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="6" style="text-align: center;">Belum ada laporan yang masuk.</td></tr>';
                    return;
                }

                reports.forEach((report, index) => {
                    const formattedDate = new Date(report.jadwal_pertemuan).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
                    const statusClass = `status-${report.status.replace(/\s+/g, '-')}`;
                    const rowHTML = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${escapeHTML(report.nama_lengkap)}</td>
                            <td>${escapeHTML(report.jenis_layanan)}</td>
                            <td>${formattedDate}</td>
                            <td><span class="status-badge ${statusClass}">${escapeHTML(report.status)}</span></td>
                            <td class="action-buttons">
                                <button class="view-btn" data-id="${report.id}" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </button>
                                <button class="delete-btn" data-id="${report.id}" title="Hapus Laporan">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </button>
                            </td>
                        </tr>
                    `;
                    tableBody.insertAdjacentHTML('beforeend', rowHTML);
                });

            } catch (error) {
                console.error('Fetch error:', error);
                tableBody.innerHTML = '<tr><td colspan="6" style="text-align: center; color: var(--status-red);">Gagal memuat data.</td></tr>';
            }
        };

        // --- Fungsi Aksi ---
        const viewReport = async (id) => {
            modalBody.innerHTML = '<p>Memuat detail...</p>';
            modal.classList.add('visible');
            try {
                const response = await fetch(`<?= base_url('/admin/report/') ?>${id}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                if (!response.ok) throw new Error('Data tidak ditemukan');
                
                const report = await response.json();
                const tglLaporan = new Date(report.tanggal_laporan).toLocaleString('id-ID', { dateStyle: 'full', timeStyle: 'short' });
                const tglPertemuan = new Date(report.jadwal_pertemuan).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                
                const contentHTML = `
                    <dl class="detail-grid">
                        <dt>Tanggal Laporan</dt><dd>${tglLaporan} WITA</dd>
                        <dt>Nama Klien</dt><dd>${escapeHTML(report.nama_lengkap)}</dd>
                        <dt>No. HP/WA</dt><dd>${escapeHTML(report.no_hp)}</dd>
                        <dt>Email</dt><dd>${escapeHTML(report.email)}</dd>
                        <dt>Alamat</dt><dd>${escapeHTML(report.alamat)}, ${escapeHTML(report.kelurahan)}, ${escapeHTML(report.kecamatan)}, ${escapeHTML(report.kota)}, ${escapeHTML(report.provinsi)}</dd>
                        <dt>Jenis Layanan</dt><dd>${escapeHTML(report.jenis_layanan)}</dd>
                        <dt>Jadwal Pertemuan</dt><dd>${tglPertemuan}</dd>
                        <dt>Deskripsi Kasus</dt><dd class="deskripsi-kasus">${escapeHTML(report.deskripsi_kasus)}</dd>
                    </dl>
                `;
                modalBody.innerHTML = contentHTML;
                reportIdInput.value = report.id;
                statusSelect.value = report.status;
            } catch (error) {
                modalBody.innerHTML = `<p style="color: var(--status-red);">${error.message}</p>`;
            }
        };

        const deleteReport = (id) => {
             Swal.fire({
                title: 'Anda Yakin?',
                text: "Laporan yang sudah dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'var(--status-red)',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: 'var(--admin-panel-bg)',
                color: 'var(--admin-text-light)'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`<?= base_url('/admin/report/') ?>${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json().then(data => ({ ok: response.ok, data })))
                    .then(({ ok, data }) => {
                        if (!ok) throw new Error(data.message || 'Gagal menghapus data.');
                        Swal.fire({
                            title: 'Dihapus!', text: data.message, icon: 'success',
                            background: 'var(--admin-panel-bg)', color: 'var(--admin-text-light)',
                            timer: 1500, showConfirmButton: false,
                        });
                        fetchReports();
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Gagal!', text: error.message, icon: 'error',
                            background: 'var(--admin-panel-bg)', color: 'var(--admin-text-light)'
                        });
                    });
                }
            });
        };
        
        // --- Event Listeners ---
        // Event delegation untuk tombol di dalam tabel
        tableBody.addEventListener('click', (event) => {
            const viewButton = event.target.closest('.view-btn');
            if (viewButton) viewReport(viewButton.dataset.id);

            const deleteButton = event.target.closest('.delete-btn');
            if (deleteButton) deleteReport(deleteButton.dataset.id);
        });

        // Event listener untuk menutup modal
        modalCloseBtn.addEventListener('click', () => modal.classList.remove('visible'));
        modal.addEventListener('click', (event) => {
            if (event.target === modal) modal.classList.remove('visible');
        });

        // Event listener untuk form update status
        statusForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const formData = new FormData(statusForm);
            
            fetch('<?= base_url('/admin/report/update-status') ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: new URLSearchParams(formData)
            })
            .then(response => response.json().then(data => ({ ok: response.ok, data })))
            .then(({ ok, data }) => {
                if (!ok) throw new Error(data.message || 'Gagal memperbarui status.');
                
                Swal.fire({
                    toast: true, position: 'top-end', icon: 'success',
                    title: 'Status diperbarui', showConfirmButton: false, timer: 2000
                });

                modal.classList.remove('visible');
                fetchReports(); // Refresh tabel
            })
            .catch(error => {
                Swal.fire({
                    title: 'Gagal!', text: error.message, icon: 'error',
                    background: 'var(--admin-panel-bg)', color: 'var(--admin-text-light)'
                });
            });
        });

        // --- Fungsi Pembantu & Panggilan Awal ---
        function escapeHTML(str) {
            return str ? String(str).replace(/[&<>'"]/g, tag => ({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#39;','"':'&quot;'}[tag]||tag)) : '';
        }

        fetchReports(); // Memuat data pertama kali
    });
</script>
</body>
</html>