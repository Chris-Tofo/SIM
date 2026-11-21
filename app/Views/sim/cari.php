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
<body class="bg-light">

    <!-- Top Navbar -->
    <nav class="navbar navbar-dark bg-dark px-4 py-3 shadow-sm">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <span class="navbar-brand fw-bold fs-6 mb-0">
                <i class="bi bi-shield-check text-primary me-1"></i> Pendaftaran SIM Online
            </span>
            <a href="/" class="text-white text-decoration-none small fw-semibold">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Formulir
            </a>
        </div>
    </nav>

    <!-- Container Utama Form Pencarian NIK -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-sm border-0 p-4" style="max-width: 480px; width: 100%;">
            
            <div class="text-center mb-4">
                <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex p-3 fs-3 mb-2">
                    <i class="bi bi-search"></i>
                </div>
                <h5 class="fw-bold text-dark">Cek Data Pendaftaran SIM</h5>
                <p class="text-muted small">Masukkan 16 digit NIK Anda untuk melihat hasil formulir dan mencetak bukti pendaftaran SIM.</p>
            </div>

            <!-- Pesan Error Flashdata jika NIK tidak ditemukan -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger py-2 small mb-3 border-0 bg-danger-subtle text-danger">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i> <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form action="/sim/cari/proses" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Nomor Induk Kependudukan (NIK)</label>
                    <input type="text" name="nik" class="form-control" placeholder="Contoh: 7173051010800001" maxlength="16" required pattern="[0-9]{16}">
                    <div class="form-text" style="font-size: 0.75rem;">Masukkan tepat 16 digit angka NIK KTP Anda.</div>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">
                    <i class="bi bi-file-earmark-text-fill me-1"></i> Lihat Hasil Formulir
                </button>
            </form>

            <div class="text-center mt-4 border-top pt-3">
                <a href="/create" class="text-decoration-none small text-muted">Belum melakukan pendaftaran? Buat formulir baru di sini</a>
            </div>

        </div>
    </div>

</body>
</html>