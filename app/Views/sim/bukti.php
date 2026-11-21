<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .card { border: none !important; box-shadow: none !important; }
        }
    </style>
</head>
<body class="bg-light py-5">

    <div class="container" style="max-width: 800px;">
        <div class="card shadow-sm border-0 p-4">
            
            <!-- Header Surat / Instansi -->
            <div class="text-center border-bottom pb-3 mb-4">
                <h5 class="fw-bold text-uppercase mb-1">Kepolisian Negara Republik Indonesia</h5>
                <h6 class="text-uppercase fw-semibold text-muted mb-0">Korps Lalu Lintas (Korlantas Polri)</h6>
                <p class="small text-muted mb-0">Tanda Bukti Registrasi Online Surat Izin Mengemudi (SIM)</p>
            </div>

            <!-- Flash Success Message -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success no-print mb-4 py-2 small">
                    <i class="bi bi-check-circle-fill me-1"></i> <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <!-- Konten Utama Bukti Pendaftaran -->
            <div class="row g-4 align-items-center mb-4">
                <div class="col-md-3 text-center">
                    <?php if (!empty($row['Pas_Foto'])) : ?>
                        <img src="<?= base_url('uploads/pas_foto/' . $row['Pas_Foto']); ?>" alt="Pas Foto" class="img-fluid rounded border shadow-sm" style="width: 130px; height: 160px; object-fit: cover;">
                    <?php else : ?>
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded" style="width: 130px; height: 160px; margin: auto;">Foto Tidak Ada</div>
                    <?php endif; ?>
                </div>
                <div class="col-md-9">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td class="fw-bold text-muted" width="35%">No. Registrasi / SIM</td>
                            <td class="fw-bold text-primary">: <?= $row['No_SIM']; ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Golongan SIM</td>
                            <td>: <span class="badge bg-dark">SIM <?= $row['Jenis_SIM']; ?></span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">NIK</td>
                            <td>: <?= $row['NIK']; ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Nama Lengkap</td>
                            <td class="fw-semibold">: <?= $row['Nama_Pemohon']; ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Tempat/Tgl Lahir</td>
                            <td>: <?= $row['Tempat_Lahir']; ?>, <?= $row['Tanggal_Lahir']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="border-top pt-3 mb-4">
                <h6 class="fw-bold small text-uppercase text-secondary mb-3">Detail Alamat & Lokasi Satpas</h6>
                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="fw-bold text-muted" width="35%">Alamat Pemohon</td>
                        <td>: <?= $row['Jalan']; ?>, RT/RW <?= $row['RT_RW']; ?>, Kel. <?= $row['Kelurahan']; ?>, Kec. <?= $row['Kecamatan']; ?>, Kab/Kota <?= $row['Kota']; ?>, Prov. <?= $row['Provinsi']; ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-muted">Lokasi Satpas Tujuan</td>
                        <td class="fw-semibold text-dark">: <?= $row['Nama_Satpas']; ?> (Kode: <?= $row['Kode_Satpas']; ?>)</td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-muted">Masa Berlaku Pengajuan</td>
                        <td>: <?= $row['Masa_Berlaku']; ?></td>
                    </tr>
                </table>
            </div>

            <div class="border-top pt-3 mb-4">
                <h6 class="fw-bold small text-uppercase text-secondary mb-3">
                    <i class="bi bi-file-earmark-text-fill me-1"></i> Dokumen Persyaratan Pendukung
                </h6>
                <div class="row g-2">
                    <!-- e-KTP -->
                    <div class="col-md-3 col-6">
                        <div class="p-2 border rounded bg-light text-center">
                            <div class="small fw-bold text-dark mb-1">Scan e-KTP</div>
                            <?php if (!empty($row['file_ktp'])) : ?>
                                <a href="<?= base_url('uploads/dokumen/' . $row['file_ktp']); ?>" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                                    <i class="bi bi-eye-fill me-1"></i> Lihat Dokumen
                                </a>
                            <?php else : ?>
                                <span class="badge bg-secondary w-100 py-2">Tidak Ada</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Surat Sehat Jasmani -->
                    <div class="col-md-3 col-6">
                        <div class="p-2 border rounded bg-light text-center">
                            <div class="small fw-bold text-dark mb-1">Sehat Jasmani</div>
                            <?php if (!empty($row['file_sehat'])) : ?>
                                <a href="<?= base_url('uploads/dokumen/' . $row['file_sehat']); ?>" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                                    <i class="bi bi-eye-fill me-1"></i> Lihat Dokumen
                                </a>
                            <?php else : ?>
                                <span class="badge bg-secondary w-100 py-2">Tidak Ada</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Surat Psikologi / Rohani -->
                    <div class="col-md-3 col-6">
                        <div class="p-2 border rounded bg-light text-center">
                            <div class="small fw-bold text-dark mb-1">Tes Psikologi</div>
                            <?php if (!empty($row['file_psikologi'])) : ?>
                                <a href="<?= base_url('uploads/dokumen/' . $row['file_psikologi']); ?>" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                                    <i class="bi bi-eye-fill me-1"></i> Lihat Dokumen
                                </a>
                            <?php else : ?>
                                <span class="badge bg-secondary w-100 py-2">Tidak Ada</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Kartu BPJS / JKN -->
                    <div class="col-md-3 col-6">
                        <div class="p-2 border rounded bg-light text-center">
                            <div class="small fw-bold text-dark mb-1">Kartu BPJS</div>
                            <?php if (!empty($row['file_bpjs'])) : ?>
                                <a href="<?= base_url('uploads/dokumen/' . $row['file_bpjs']); ?>" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                                    <i class="bi bi-eye-fill me-1"></i> Lihat Dokumen
                                </a>
                            <?php else : ?>
                                <span class="badge bg-secondary w-100 py-2">Tidak Ada</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Petunjuk Cetak -->
            <div class="alert alert-warning small border-0 bg-warning-subtle text-dark p-3 mb-4 no-print">
                <i class="bi bi-info-circle-fill me-1"></i> Harap cetak atau simpan lembar tanda bukti pendaftaran ini untuk ditunjukkan kepada petugas saat melakukan verifikasi fisik di Satpas yang dipilih.
            </div>

            <!-- Tombol Aksi (Hilang saat diprint) -->
            <div class="d-flex justify-content-between no-print border-top pt-3">
                <a href="/create" class="btn btn-outline-secondary fw-bold px-4">
                    <i class="bi bi-arrow-left me-1"></i> Buat Pendaftaran Baru
                </a>
                <button onclick="window.print()" class="btn btn-primary fw-bold px-5 shadow">
                    <i class="bi bi-printer-fill me-1"></i> Cetak Formulir Pendaftaran
                </button>
            </div>

        </div>
    </div>

</body>
</html>