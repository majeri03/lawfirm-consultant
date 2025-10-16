document.addEventListener('DOMContentLoaded', function() {
    const provinsiSelect = document.getElementById('provinsi');
    const kotaSelect = document.getElementById('kota');
    const kecamatanSelect = document.getElementById('kecamatan');
    const kelurahanSelect = document.getElementById('kelurahan');

    const apiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/';

    // Fetch Provinsi
    fetch(`${apiBaseUrl}provinces.json`)
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
        kecamatanSelect.innerHTML = '<option value="">Pilih Kota Dahulu</option>';
        kecamatanSelect.disabled = true;
        kelurahanSelect.innerHTML = '<option value="">Pilih Kecamatan Dahulu</option>';
        kelurahanSelect.disabled = true;

        if (provinceId) {
            fetch(`${apiBaseUrl}regencies/${provinceId}.json`)
                .then(response => response.json())
                .then(regencies => {
                    kotaSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                    regencies.forEach(regency => {
                        const option = document.createElement('option');
                        option.value = regency.id;
                        option.textContent = regency.name;
                        kotaSelect.appendChild(option);
                    });
                    kotaSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error fetching regencies:', error);
                    kotaSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                });
        }
    });

    // Event listener untuk perubahan kota/kabupaten
    kotaSelect.addEventListener('change', function() {
        const regencyId = this.value;
        kecamatanSelect.innerHTML = '<option value="">Memuat Kecamatan...</option>';
        kecamatanSelect.disabled = true;
        kelurahanSelect.innerHTML = '<option value="">Pilih Kecamatan Dahulu</option>';
        kelurahanSelect.disabled = true;

        if (regencyId) {
            fetch(`${apiBaseUrl}districts/${regencyId}.json`)
                .then(response => response.json())
                .then(districts => {
                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    districts.forEach(district => {
                        const option = document.createElement('option');
                        option.value = district.id;
                        option.textContent = district.name;
                        kecamatanSelect.appendChild(option);
                    });
                    kecamatanSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error fetching districts:', error);
                    kecamatanSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                });
        }
    });

    // Event listener untuk perubahan kecamatan
    kecamatanSelect.addEventListener('change', function() {
        const districtId = this.value;
        kelurahanSelect.innerHTML = '<option value="">Memuat Kelurahan...</option>';
        kelurahanSelect.disabled = true;

        if (districtId) {
            fetch(`${apiBaseUrl}villages/${districtId}.json`)
                .then(response => response.json())
                .then(villages => {
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    villages.forEach(village => {
                        const option = document.createElement('option');
                        option.value = village.name;
                        option.textContent = village.name;
                        kelurahanSelect.appendChild(option);
                    });
                    kelurahanSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error fetching villages:', error);
                    kelurahanSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                });
        }
    });
});