<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
</head>
<body>

    <!-- Navbar Utama -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 py-3 shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="bi bi-shield-check text-primary me-2"></i> SIM Online Indonesia
            </a>
            <div class="d-flex gap-3">
                <a href="/sim/cari" class="btn btn-outline-light btn-sm px-3">
                    <i class="bi bi-search me-1"></i> Cek Data Pendaftaran
                </a>
                <a href="/create" class="btn btn-primary btn-sm px-4 fw-bold shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Daftar Sekarang
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section / Landing Page Header -->
    <header class="hero-section text-center">
        <div class="container" style="max-width: 800px;">
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill mb-3 fw-semibold">
                <i class="bi bi-patch-check-fill me-1"></i> Layanan Resmi Pendaftaran SIM Elektronik
            </span>
            <h1 class="display-5 fw-bold mb-3">Ajukan SIM dengan Lebih Cepat, Aman, & Terarah</h1>
            <p class="text-white-50 fs-6 mb-4">
                Sistem pendaftaran Surat Izin Mengemudi (SIM) secara online. Isi data diri bertahap, pilih lokasi Satpas terdekat di seluruh Indonesia, dan cetak bukti registrasi Anda seketika.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="/create" class="btn btn-primary btn-lg px-5 fw-bold shadow">
                    <i class="bi bi-arrow-right-circle me-2"></i> Mulai Isi Formulir
                </a>
                <a href="#faq" class="btn btn-outline-light btn-lg px-4">
                    Pelajari FAQ
                </a>
            </div>
        </div>
    </header>

    <!-- Syarat & Ketentuan -->
    <section class="container py-5">
        <div class="text-center mb-5">
            <h3 class="fw-bold text-dark">Syarat & Ketentuan Pengajuan</h3>
            <p class="text-muted small">Pastikan Anda memenuhi persyaratan berikut sebelum melakukan pengisian formulir online.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card shadow-sm p-4 h-100 bg-white">
                    <div class="text-primary fs-3 mb-3"><i class="bi bi-person-badge"></i></div>
                    <h5 class="fw-bold">1. Kartu Identitas (KTP)</h5>
                    <p class="text-muted small mb-0">Pemohon wajib memiliki NIK yang valid dan terdaftar di Dukcapil dengan usia minimum sesuai golongan SIM (misal: 17 tahun untuk SIM A/C).</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card shadow-sm p-4 h-100 bg-white">
                    <div class="text-primary fs-3 mb-3"><i class="bi bi-file-earmark-image"></i></div>
                    <h5 class="fw-bold">2. Pas Foto Terbaru</h5>
                    <p class="text-muted small mb-0">Menyiapkan pas foto formal berukuran proporsional dengan latar belakang cerah dan ukuran file maksimal 2 MB.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card shadow-sm p-4 h-100 bg-white">
                    <div class="text-primary fs-3 mb-3"><i class="bi bi-geo-alt"></i></div>
                    <h5 class="fw-bold">3. Pemilihan Satpas</h5>
                    <p class="text-muted small mb-0">Menentukan lokasi kantor Satpas kepolisian terdekat di kota Anda untuk proses verifikasi fisik dan ujian lanjutan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="bg-white py-5 border-top">
        <div class="container" style="max-width: 800px;">
            <div class="text-center mb-5">
                <h3 class="fw-bold text-dark">Pertanyaan yang Sering Diajukan (FAQ)</h3>
                <p class="text-muted small">Temukan jawaban seputar alur dan kendala pendaftaran SIM online.</p>
            </div>
            
            <div class="accordion shadow-sm" id="faqAccordion">
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            Bagaimana cara melihat kembali bukti pendaftaran yang sudah dibuat?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted small">
                            Anda dapat mengeklik tombol <strong>"Cek Data Pendaftaran"</strong> di bagian atas halaman, lalu masukkan 16 digit NIK Anda untuk mengakses dan mencetak ulang lembar bukti pendaftaran.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                            Apakah data yang sudah dikirim bisa diubah kembali?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted small">
                            Tidak. Setelah Anda menekan tombol konfirmasi akhir di Langkah 4, data akan tersimpan permanen di database. Pastikan memeriksa kembali isian Anda pada tahap *Review* sebelum mengirimkannya.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                            Apa yang harus dibawa saat datang ke kantor Satpas?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted small">
                            Bawa cetakan lembar <strong>Bukti Pendaftaran Online</strong>, KTP asli beserta fotokopi, serta surat keterangan sehat jasmani dan rohani sesuai ketentuan kepolisian setempat.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer & Social Media -->
    <footer class="bg-dark text-white py-4 px-4 mt-5">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <div>
                <span class="fw-bold fs-6"><i class="bi bi-shield-check text-primary me-1"></i> Korlantas Polri</span>
                <p class="text-white-50 small mb-0">Sistem Pendaftaran Surat Izin Mengemudi Online Berbasis Digital.</p>
            </div>
            <!-- Social Media Icons -->
            <div class="d-flex gap-3 fs-5">
                <a href="#" class="text-white text-decoration-none" title="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white text-decoration-none" title="YouTube"><i class="bi bi-youtube"></i></a>
                <a href="#" class="text-white text-decoration-none" title="Twitter / X"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="text-white text-decoration-none" title="Facebook"><i class="bi bi-facebook"></i></a>
            </div>
        </div>
        <div class="text-center text-white-50 mt-3 pt-3 border-top border-secondary small">
            &copy; 2026 Portal SIM Online Indonesia. Seluruh hak cipta dilindungi.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>