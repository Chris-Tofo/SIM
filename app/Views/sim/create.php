<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Pendaftaran SIM Online'; ?></title>
    
    <!-- External CSS (Bootstrap & Fonts) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Custom Modular CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
</head>
<body>

    <div id="splash-screen">
        <div class="splash-content">
            <div class="spinner-border text-primary mb-3" style="width: 3.5rem; height: 3.5rem;" role="status"></div>
            <h4 class="fw-bold mb-1 text-white"><i class="bi bi-shield-check text-primary me-2"></i> Pendaftaran SIM Online</h4>
            <p class="text-white-50 small">Memuat formulir pendaftaran...</p>
        </div>
    </div>

    <!-- Top Navbar -->
    <nav class="top-nav">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <div class="bg-primary text-white rounded-2 px-2 py-1 fs-6 fw-bold">
                    <i class="bi bi-shield-check"></i>
                </div>
                <span class="text-white fw-bold">Pendaftaran SIM Online</span>
            </div>
            <div class="d-flex gap-3 small text-white-50">
                <a href="/sim/cari" class="text-white-50 text-decoration-none">
                    <i class="bi bi-search"></i> Lihat Data Pendaftaran
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Header -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="hero-badge">
                        <i class="bi bi-patch-check-fill"></i> Prototipe Layanan Resmi (Experimental)
                    </div>
                    <h1 class="hero-title">
                        Ajukan SIM dengan <span>lebih terarah.</span>
                    </h1>
                    <p class="text-white-50 small mt-2">
                        Isi data pemohon secara bertahap, periksa kembali sebelum dikirim, dan dapatkan nomor registrasi SIM.
                    </p>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="status-card">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-uppercase small fw-bold text-white-50">STATUS LAYANAN</span>
                            <span class="badge bg-success rounded-pill px-2">●</span>
                        </div>
                        <h6 class="text-white fw-bold mb-1" id="step-status-title">Formulir siap diisi</h6>
                        <div class="progress-bar-custom my-2">
                            <div class="progress-bar-fill" id="progress-fill"></div>
                        </div>
                        <div class="d-flex justify-content-between small text-white-50">
                            <span id="step-indicator-text">Mulai dari langkah 1</span>
                            <span id="percent-text">0%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="container form-container-wrapper">
        <div class="form-card">

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Perhatian! Validasi Form Gagal:</strong>
                <ul class="mb-0 mt-1">
                    <?php foreach (session()->getFlashdata('errors') as $err) : ?>
                        <li><?= esc($err); ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
            
            <form action="/store" method="post" id="formPendaftaran" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <!-- Jenis Permohonan & Golongan SIM -->
                <div class="step-section active" id="step-1">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="text-primary fw-bold text-uppercase small">LANGKAH 1 DARI 4</span>
                    </div>
                    <h6 class="text-muted small fw-semibold">Jenis SIM / Kebutuhan Anda</h6>
                    <hr class="mt-1 mb-4">

                    <!-- Jenis Permohonan -->
                    <label class="form-label text-uppercase fw-bold small text-muted">JENIS PERMOHONAN <span class="text-danger">*</span></label>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="option-card active" onclick="selectOption('jenis_permohonan', 'Baru', this)">
                                <input type="radio" name="jenis_permohonan" value="Baru" checked>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fw-bold text-dark">SIM Baru</div>
                                        <div class="text-muted small">Pengajuan SIM untuk pertama kali</div>
                                    </div>
                                    <i class="bi bi-check-circle-fill check-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="option-card" onclick="selectOption('jenis_permohonan', 'Perpanjangan', this)">
                                <input type="radio" name="jenis_permohonan" value="Perpanjangan">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fw-bold text-dark">Perpanjangan</div>
                                        <div class="text-muted small">Memperpanjang masa berlaku SIM</div>
                                    </div>
                                    <i class="bi bi-check-circle-fill check-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Golongan SIM -->
                    <label class="form-label text-uppercase fw-bold small text-muted">GOLONGAN SIM <span class="text-danger">*</span></label>
                    <input type="hidden" name="jenis_sim" id="jenis_sim_input" value="A">
                    <div class="row g-3 mb-4">
                        <div class="col">
                            <div class="golongan-card active" onclick="selectGolongan('A', this)">
                                <div class="golongan-title mb-1">A</div>
                                <div class="text-muted small" style="font-size: 0.75rem;">Mobil penumpang & barang perseorangan</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="golongan-card" onclick="selectGolongan('C', this)">
                                <div class="golongan-title mb-1">C</div>
                                <div class="text-muted small" style="font-size: 0.75rem;">Sepeda motor hingga 250 cc</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="golongan-card" onclick="selectGolongan('C1', this)">
                                <div class="golongan-title mb-1">C1</div>
                                <div class="text-muted small" style="font-size: 0.75rem;">Sepeda motor 250–500 cc</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="golongan-card" onclick="selectGolongan('B1', this)">
                                <div class="golongan-title mb-1">B1</div>
                                <div class="text-muted small" style="font-size: 0.75rem;">Kendaraan perseorangan berat</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="golongan-card" onclick="selectGolongan('D', this)">
                                <div class="golongan-title mb-1">D</div>
                                <div class="text-muted small" style="font-size: 0.75rem;">Penyandang disabilitas</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-dark px-4 fw-bold" onclick="nextStep(2)">Lanjutkan <i class="bi bi-arrow-right ms-1"></i></button>
                    </div>
                </div>

                <!-- LANGKAH 2: Data Pemohon -->
                <div class="step-section" id="step-2">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="text-primary fw-bold text-uppercase small">LANGKAH 2 DARI 4</span>
                    </div>
                    <h6 class="text-muted small fw-semibold">Data Pemohon & Wilayah</h6>
                    <hr class="mt-1 mb-4">

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">NIK (Nomor Induk Kependudukan) <span class="text-danger">*</span></label>
                            <input type="text" name="nik" class="form-control" placeholder="16 digit NIK" maxlength="16" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_pemohon" class="form-control" placeholder="Nama sesuai KTP" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" placeholder="Kota lahir">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Golongan Darah</label>
                            <select name="golongan_darah" class="form-select">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small">Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan Anda saat ini">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold small">Alamat Jalan <span class="text-danger">*</span></label>
                            <input type="text" name="jalan" class="form-control" placeholder="Jl. Merdeka No. 10" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">RT / RW <span class="text-danger">*</span></label>
                            <input type="text" name="rt_rw" class="form-control" placeholder="001/002" required>
                        </div>
                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Provinsi <span class="text-danger">*</span></label>
                                <select id="select-provinsi" class="form-select" required>
                                    <option value="">-- Pilih Provinsi --</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Kabupaten / Kota <span class="text-danger">*</span></label>
                                <select id="select-kota" class="form-select" disabled required>
                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Kecamatan <span class="text-danger">*</span></label>
                                <select id="select-kecamatan" class="form-select" disabled required>
                                    <option value="">-- Pilih Kecamatan --</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Kelurahan / Desa <span class="text-danger">*</span></label>
                                <select name="id_kelurahan" id="select-kelurahan" class="form-select" disabled required>
                                    <option value="">-- Pilih Kelurahan --</option>
                                </select>
                            </div>
                        </div>

                        <!-- Hidden Input untuk mengirim teks nama wilayah secara lengkap ke Controller -->
                        <input type="hidden" name="nama_provinsi" id="nama_provinsi">
                        <input type="hidden" name="nama_kota" id="nama_kota">
                        <input type="hidden" name="nama_kecamatan" id="nama_kecamatan">
                        <input type="hidden" name="nama_kelurahan" id="nama_kelurahan">

                        <div class="col-md-12 mt-3">
                            <label class="form-label fw-semibold small">Pas Foto Pemohon (Latar Merah / Biru) <span class="text-danger">*</span></label>
                            <input type="file" name="pas_foto" id="pas_foto_input" class="form-control" accept="image/png, image/jpeg, image/jpg" required>
                            <div class="form-text small">Format file yang diperbolehkan: JPG, JPEG, PNG. Ukuran maksimal 2 MB.</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary px-4 fw-bold" onclick="nextStep(1)"><i class="bi bi-arrow-left me-1"></i> Kembali</button>
                        <button type="button" class="btn btn-dark px-4 fw-bold" onclick="nextStep(3)">Lanjutkan <i class="bi bi-arrow-right ms-1"></i></button>
                    </div>
                </div>

                <!-- LANGKAH 3: Penunjukan Satpas -->
                <div class="step-section" id="step-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="text-primary fw-bold text-uppercase small">LANGKAH 3 DARI 4</span>
                    </div>
                    <h6 class="text-muted small fw-semibold">Lokasi Satpas & Finalisasi</h6>
                    <hr class="mt-1 mb-4">

                    <div class="mb-4">
                        <label class="form-label fw-semibold small">Lokasi Satpas Penerbit <span class="text-danger">*</span></label>
                        <select name="kode_satpas" class="form-select form-select-lg fs-6" required>
                            <option value="">-- Pilih Satpas --</option>
                            <?php if (!empty($satpas)): ?>
                                <?php foreach ($satpas as $s): ?>
                                    <option value="<?= $s['Kode_Satpas']; ?>">
                                        <?= $s['Nama_Satpas']; ?> (Kode: <?= $s['Kode_Satpas']; ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="alert alert-warning border-0 bg-warning-subtle text-dark p-3 rounded-3 mb-4">
                        <div class="d-flex gap-2">
                            <i class="bi bi-exclamation-triangle-fill text-warning fs-5"></i>
                            <div>
                                <strong class="d-block mb-1">Konfirmasi Data</strong>
                                <span class="small">Pastikan data NIK dan pilihan Satpas Anda sudah benar sebelum dikirim.</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary px-4 fw-bold" onclick="nextStep(2)"><i class="bi bi-arrow-left me-1"></i> Kembali</button>
                        <button type="button" class="btn btn-dark px-4 fw-bold" onclick="nextStep(4)">Lanjutkan <i class="bi bi-arrow-right ms-1"></i></button>
                    </div>
                </div>

<!-- LANGKAH 4: Dokumen Pendukung, Review & Konfirmasi -->
                <div class="step-section" id="step-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="text-primary fw-bold text-uppercase small">LANGKAH 4 DARI 4</span>
                    </div>
                    <h6 class="text-muted small fw-semibold">Dokumen Pendukung & Review Pendaftaran</h6>
                    <hr class="mt-1 mb-4">

                    <!-- Kotak Unggah Dokumen Pendukung -->
                    <div class="card bg-light border-0 p-4 mb-4 shadow-sm">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-folder-check text-primary me-2"></i> Unggah Dokumen Syarat Pendukung</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Scan / Foto e-KTP <span class="text-danger">*</span></label>
                                <input type="file" name="file_ktp" class="form-control form-control-sm" accept="image/png, image/jpeg, image/jpg, application/pdf" required>
                                <div class="form-text" style="font-size: 0.75rem;">Format: JPG, PNG, PDF (Maks. 2 MB)</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Surat Keterangan Sehat Jasmani <span class="text-danger">*</span></label>
                                <input type="file" name="file_sehat" class="form-control form-control-sm" accept="image/png, image/jpeg, image/jpg, application/pdf" required>
                                <div class="form-text" style="font-size: 0.75rem;">Format: JPG, PNG, PDF (Maks. 2 MB)</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Surat Sehat Rohani (Tes Psikologi) <span class="text-danger">*</span></label>
                                <input type="file" name="file_psikologi" class="form-control form-control-sm" accept="image/png, image/jpeg, image/jpg, application/pdf" required>
                                <div class="form-text" style="font-size: 0.75rem;">Format: JPG, PNG, PDF (Maks. 2 MB)</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Kartu BPJS Kesehatan / JKN Aktif <span class="text-danger">*</span></label>
                                <input type="file" name="file_bpjs" class="form-control form-control-sm" accept="image/png, image/jpeg, image/jpg, application/pdf" required>
                                <div class="form-text" style="font-size: 0.75rem;">Format: JPG, PNG, PDF (Maks. 2 MB)</div>
                            </div>
                        </div>
                    </div>

                    <!-- Review Data & Pas Foto -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4 text-center">
                            <div class="border p-3 rounded bg-light shadow-sm">
                                <img id="preview-foto" src="" alt="Pas Foto" class="img-fluid rounded border mb-2" style="width: 120px; height: 150px; object-fit: cover;">
                                <div class="small fw-bold text-dark">Pas Foto Pemohon</div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-sm table-borderless">
                                <tr><td class="fw-bold text-muted" width="35%">Jenis / Gol SIM</td><td>: <span id="prev-jenis-sim" class="fw-semibold text-dark">-</span></td></tr>
                                <tr><td class="fw-bold text-muted">NIK</td><td>: <span id="prev-nik" class="fw-semibold text-dark">-</span></td></tr>
                                <tr><td class="fw-bold text-muted">Nama Lengkap</td><td>: <span id="prev-nama" class="fw-semibold text-dark">-</span></td></tr>
                                <tr><td class="fw-bold text-muted">Tempat/Tgl Lahir</td><td>: <span id="prev-ttl" class="fw-semibold text-dark">-</span></td></tr>
                                <tr><td class="fw-bold text-muted">Alamat & RT/RW</td><td>: <span id="prev-alamat" class="fw-semibold text-dark">-</span></td></tr>
                                <tr><td class="fw-bold text-muted">Wilayah</td><td>: <span id="prev-wilayah" class="fw-semibold text-dark">-</span></td></tr>
                                <tr><td class="fw-bold text-muted">Lokasi Satpas</td><td>: <span id="prev-satpas" class="fw-semibold text-dark">-</span></td></tr>
                            </table>
                        </div>
                    </div>

                    <div class="alert alert-success border-0 bg-success-subtle text-dark p-3 rounded-3 mb-4">
                        <div class="d-flex gap-2 align-items-center">
                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                            <div>
                                <strong>Konfirmasi Akhir</strong>
                                <div class="small">Pastikan seluruh dokumen dan data di atas sudah benar. Klik tombol konfirmasi hijau di bawah untuk menyelesaikan pendaftaran.</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary px-4 fw-bold" onclick="nextStep(3)"><i class="bi bi-arrow-left me-1"></i> Kembali</button>
                        <button type="button" class="btn btn-success px-5 fw-bold shadow" onclick="konfirmasiKirim()"><i class="bi bi-check-circle-fill me-1"></i> Konfirmasi & Kirim</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <!-- Footer Layanan Resmi -->
    <footer class="bg-white border-top py-4 mt-auto">
        <div class="container">
            <div class="row align-items-center gy-3">
                <div class="col-md-6 text-center text-md-start">
                    <div class="d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                        <div class="bg-primary text-white rounded-2 px-2 py-1 fs-6 fw-bold">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <span class="fw-bold text-dark">Pendaftaran SIM Online</span>
                    </div>
                    <p class="text-muted small mb-0 mt-1">
                        Layanan pendaftaran dan perpanjangan Surat Izin Mengemudi secara terpadu.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="small text-muted mb-1">
                        <i class="bi bi-lock-fill text-success me-1"></i> Koneksi Enkripsi Aman
                    </div>
                    <div class="small text-muted">
                        &copy; <?= date('Y'); ?> Korlantas Polri. Seluruh hak cipta dilindungi.
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?= base_url('js/style.js'); ?>"></script>

    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                const splash = document.getElementById('splash-screen');
                if (splash) {
                    splash.style.opacity = '0';
                    splash.style.visibility = 'hidden';
                    setTimeout(() => splash.remove(), 600);
                }
            }, 800);
        });
    </script>
</body>
</html>