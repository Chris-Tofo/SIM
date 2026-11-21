function selectOption(name, value, element) {
    document.querySelectorAll(`input[name="${name}"]`).forEach(input => {
        input.checked = false;
        input.closest('.option-card').classList.remove('active');
    });
    const input = element.querySelector('input');
    input.checked = true;
    element.classList.add('active');
}

function selectGolongan(val, element) {
    document.querySelectorAll('.golongan-card').forEach(card => card.classList.remove('active'));
    element.classList.add('active');
    document.getElementById('jenis_sim_input').value = val;
}

function nextStep(stepNumber) {
    
    // -------------------------------------------------------------
    // VALIDASI LANGKAH 2 (Dijalankan saat akan pindah ke Langkah 3)
    // -------------------------------------------------------------
    if (stepNumber === 3) {
        const nikInput = document.querySelector('input[name="nik"]');
        const nikValue = nikInput ? nikInput.value.trim() : '';
        const regexAngka = /^[0-9]+$/;

        if (!nikValue) {
            alert('NIK tidak boleh kosong!');
            nikInput.focus();
            return;
        }
        if (!regexAngka.test(nikValue)) {
            alert('NIK hanya boleh berisi angka!');
            nikInput.focus();
            return;
        }
        if (nikValue.length !== 16) {
            alert(`NIK harus terdiri dari tepat 16 digit angka! (Saat ini: ${nikValue.length} digit)`);
            nikInput.focus();
            return;
        }

        // Validasi Ketat Nama Lengkap (Tidak boleh ada angka/simbol aneh)
        const namaInput = document.querySelector('input[name="nama_pemohon"]');
        const namaValue = namaInput ? namaInput.value.trim() : '';
        const regexNama = /^[A-Za-z\s.]+$/;

        if (!namaValue) {
            alert('Nama Lengkap wajib diisi!');
            namaInput.focus();
            return;
        }
        if (!regexNama.test(namaValue)) {
            alert('Format Nama Lengkap tidak valid! Nama hanya boleh berisi huruf dan spasi (tidak boleh mengandung angka atau simbol acak).');
            namaInput.focus();
            return;
        }

        // Validasi Tempat Lahir
        const tempatLahirInput = document.querySelector('input[name="tempat_lahir"]');
        if (!tempatLahirInput || !tempatLahirInput.value.trim()) {
            alert('Tempat Lahir wajib diisi!');
            tempatLahirInput.focus();
            return;
        }

        // Validasi Tanggal Lahir
        const tglLahirInput = document.querySelector('input[name="tanggal_lahir"]');
        if (!tglLahirInput || !tglLahirInput.value) {
            alert('Tanggal Lahir wajib diisi!');
            tglLahirInput.focus();
            return;
        }

        // Validasi Alamat Jalan
        const jalanInput = document.querySelector('input[name="jalan"]');
        const jalanValue = jalanInput ? jalanInput.value.trim() : '';
        if (!jalanValue) {
            alert('Alamat Jalan wajib diisi!');
            jalanInput.focus();
            return;
        }
        if (jalanValue.length < 5) {
            alert('Alamat Jalan terlalu singkat! Harap masukkan alamat dengan jelas.');
            jalanInput.focus();
            return;
        }

        // Validasi RT/RW
        const rtrwInput = document.querySelector('input[name="rt_rw"]');
        if (!rtrwInput || !rtrwInput.value.trim()) {
            alert('RT / RW wajib diisi!');
            rtrwInput.focus();
            return;
        }

        // Validasi Wilayah (Dropdown API)
        const selectProvinsi = document.getElementById('select-provinsi');
        const selectKota = document.getElementById('select-kota');
        const selectKecamatan = document.getElementById('select-kecamatan');
        const selectKelurahan = document.getElementById('select-kelurahan');
        const fotoInput = document.getElementById('pas_foto_input');

        if (!selectProvinsi || !selectProvinsi.value) {
            alert('Silakan pilih Provinsi terlebih dahulu!');
            selectProvinsi.focus();
            return;
        }

        if (!selectKota || !selectKota.value) {
            alert('Silakan pilih Kabupaten / Kota terlebih dahulu!');
            selectKota.focus();
            return;
        }

        if (!selectKecamatan || !selectKecamatan.value) {
            alert('Silakan pilih Kecamatan terlebih dahulu!');
            selectKecamatan.focus();
            return;
        }

        if (!selectKelurahan || !selectKelurahan.value) {
            alert('Silakan pilih Kelurahan / Desa terlebih dahulu!');
            selectKelurahan.focus();
            return;
        }

        // Validasi Pas Foto
        if (!fotoInput || fotoInput.files.length === 0) {
            alert('Silakan unggah Pas Foto Pemohon terlebih dahulu!');
            fotoInput.focus();
            return;
        }

        const fileSize = fotoInput.files[0].size / 1024 / 1024;
        if (fileSize > 2) {
            alert('Ukuran file pas foto tidak boleh lebih dari 2 MB!');
            return;
        }
    }

    // -------------------------------------------------------------
    // VALIDASI LANGKAH 3 (Dijalankan saat akan pindah ke Langkah 4 / Review)
    // -------------------------------------------------------------
    if (stepNumber === 4) {
        const satpasSelect = document.querySelector('select[name="kode_satpas"]');
        if (!satpasSelect || !satpasSelect.value) {
            alert('Silakan pilih Lokasi Satpas Tujuan terlebih dahulu!');
            satpasSelect.focus();
            return;
        }

        // MENGISI DATA REVIEW/PREVIEW SECARA OTOMATIS DI LANGKAH 4
        const jenisPermohonan = document.querySelector('input[name="jenis_permohonan"]:checked')?.value || 'Baru';
        const jenisSim = document.getElementById('jenis_sim_input').value;
        document.getElementById('prev-jenis-sim').innerText = `${jenisPermohonan} SIM ${jenisSim}`;
        
        const nikValue = document.querySelector('input[name="nik"]').value;
        const namaValue = document.querySelector('input[name="nama_pemohon"]').value;
        document.getElementById('prev-nik').innerText = nikValue;
        document.getElementById('prev-nama').innerText = namaValue;
        
        const tempatLahir = document.querySelector('input[name="tempat_lahir"]').value;
        const tglLahir = document.querySelector('input[name="tanggal_lahir"]').value;
        document.getElementById('prev-ttl').innerText = `${tempatLahir}, ${tglLahir}`;

        const jalan = document.querySelector('input[name="jalan"]').value;
        const rtrw = document.querySelector('input[name="rt_rw"]').value;
        document.getElementById('prev-alamat').innerText = `${jalan}, RT/RW ${rtrw}`;

        const prov = document.getElementById('nama_provinsi').value;
        const kota = document.getElementById('nama_kota').value;
        const kec = document.getElementById('nama_kecamatan').value;
        const kel = document.getElementById('nama_kelurahan').value;
        document.getElementById('prev-wilayah').innerText = `${kel}, ${kec}, ${kota}, ${prov}`;

        const satpasText = satpasSelect.options[satpasSelect.selectedIndex]?.text || '-';
        document.getElementById('prev-satpas').innerText = satpasText;

        // Preview Gambar Pas Foto
        const fotoInput = document.getElementById('pas_foto_input');
        if (fotoInput.files && fotoInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-foto').src = e.target.result;
            }
            reader.readAsDataURL(fotoInput.files[0]);
        }
    }

    // Pindah Tampilan Section Step
    document.querySelectorAll('.step-section').forEach(sec => sec.classList.remove('active'));
    document.getElementById(`step-${stepNumber}`).classList.add('active');

    const progressFill = document.getElementById('progress-fill');
    const percentText = document.getElementById('percent-text');
    const stepText = document.getElementById('step-indicator-text');
    const statusTitle = document.getElementById('step-status-title');

    if (stepNumber === 1) {
        progressFill.style.width = '25%';
        percentText.innerText = '25%';
        stepText.innerText = 'Langkah 1: Jenis SIM';
        statusTitle.innerText = 'Pilih Kategori';
    } else if (stepNumber === 2) {
        progressFill.style.width = '50%';
        percentText.innerText = '50%';
        stepText.innerText = 'Langkah 2: Data Pemohon';
        statusTitle.innerText = 'Pengisian Identitas';
    } else if (stepNumber === 3) {
        progressFill.style.width = '75%';
        percentText.innerText = '75%';
        stepText.innerText = 'Langkah 3: Lokasi Satpas';
        statusTitle.innerText = 'Penentuan Lokasi';
    } else if (stepNumber === 4) {
        progressFill.style.width = '100%';
        percentText.innerText = '100%';
        stepText.innerText = 'Langkah 4: Konfirmasi';
        statusTitle.innerText = 'Review & Kirim';
    }

    window.scrollTo({ top: 150, behavior: 'smooth' });
}

// Fungsi Pop-up Konfirmasi Hijau & Validasi Dokumen Pendukung
function konfirmasiKirim() {
    const ktp = document.querySelector('input[name="file_ktp"]');
    const sehat = document.querySelector('input[name="file_sehat"]');
    const psikologi = document.querySelector('input[name="file_psikologi"]');
    const bpjs = document.querySelector('input[name="file_bpjs"]');

    if (!ktp.files.length || !sehat.files.length || !psikologi.files.length || !bpjs.files.length) {
        alert('Harap unggah seluruh dokumen persyaratan pendukung (e-KTP, Surat Sehat Jasmani, Surat Psikologi, dan Kartu BPJS) terlebih dahulu!');
        return;
    }

    const yakin = confirm('Apakah Anda yakin formulir pendaftaran SIM dan dokumen pendukung sudah benar? Data yang dikirim tidak dapat diubah kembali.');
    if (yakin) {
        document.getElementById('formPendaftaran').submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const selectProvinsi = document.getElementById('select-provinsi');
    const selectKota = document.getElementById('select-kota');
    const selectKecamatan = document.getElementById('select-kecamatan');
    const selectKelurahan = document.getElementById('select-kelurahan');

    const inputProvinsi = document.getElementById('nama_provinsi');
    const inputKota = document.getElementById('nama_kota');
    const inputKecamatan = document.getElementById('nama_kecamatan');
    const inputKelurahan = document.getElementById('nama_kelurahan');

    if (!selectProvinsi) return;

    fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
        .then(response => response.json())
        .then(provinces => {
            provinces.forEach(p => {
                selectProvinsi.innerHTML += `<option value="${p.id}">${p.name}</option>`;
            });
        });

    selectProvinsi.addEventListener('change', function() {
        if(this.selectedIndex > 0) {
            inputProvinsi.value = this.options[this.selectedIndex].text;
        }
        selectKota.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';
        selectKecamatan.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        selectKelurahan.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
        
        selectKota.disabled = true;
        selectKecamatan.disabled = true;
        selectKelurahan.disabled = true;

        if (this.value) {
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${this.value}.json`)
                .then(res => res.json())
                .then(cities => {
                    cities.forEach(c => {
                        selectKota.innerHTML += `<option value="${c.id}">${c.name}</option>`;
                    });
                    selectKota.disabled = false;
                });
        }
    });

    selectKota.addEventListener('change', function() {
        if(this.selectedIndex > 0) {
            inputKota.value = this.options[this.selectedIndex].text;
        }
        selectKecamatan.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        selectKelurahan.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
        
        selectKecamatan.disabled = true;
        selectKelurahan.disabled = true;

        if (this.value) {
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${this.value}.json`)
                .then(res => res.json())
                .then(districts => {
                    districts.forEach(d => {
                        selectKecamatan.innerHTML += `<option value="${d.id}">${d.name}</option>`;
                    });
                    selectKecamatan.disabled = false;
                });
        }
    });

    selectKecamatan.addEventListener('change', function() {
        if(this.selectedIndex > 0) {
            inputKecamatan.value = this.options[this.selectedIndex].text;
        }
        selectKelurahan.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
        selectKelurahan.disabled = true;

        if (this.value) {
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${this.value}.json`)
                .then(res => res.json())
                .then(villages => {
                    villages.forEach(v => {
                        selectKelurahan.innerHTML += `<option value="${v.id}">${v.name}</option>`;
                    });
                    selectKelurahan.disabled = false;
                });
        }
    });

    selectKelurahan.addEventListener('change', function() {
        if(this.selectedIndex > 0) {
            inputKelurahan.value = this.options[this.selectedIndex].text;
        }
    });
});