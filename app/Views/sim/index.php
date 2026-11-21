<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Data Pendaftaran SIM (3NF)</h4>
                <a href="/create" class="btn btn-light btn-sm fw-bold">Tambah Pendaftaran</a>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Pas Foto</th>
                                <th>No SIM</th>
                                <th>NIK & Nama</th>
                                <th>Alamat / Wilayah</th>
                                <th>Jenis SIM</th>
                                <th>Masa Berlaku</th>
                                <th>Satpas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($pendaftaran)) : ?>
                                <tr><td colspan="6" class="text-center">Belum ada data pendaftaran.</td></tr>
                            <?php else : ?>
                                <?php foreach ($pendaftaran as $row) : ?>
                                <tr>
                                    <td class="text-center">
                                        <?php if (!empty($row['Pas_Foto'])) : ?>
                                            <img src="<?= base_url('uploads/pas_foto/' . $row['Pas_Foto']); ?>" alt="Pas Foto" class="rounded shadow-sm" style="width: 45px; height: 55px; object-fit: cover;">
                                        <?php else : ?>
                                            <span class="badge bg-secondary">Tidak Ada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><strong><?= $row['No_SIM']; ?></strong></td>
                                    <td>
                                        <?= $row['Nama_Pemohon']; ?><br>
                                        <small class="text-muted">NIK: <?= $row['NIK']; ?></small>
                                    </td>
                                    <td>
                                        <?= $row['Jalan']; ?>, RT/RW <?= $row['RT_RW']; ?><br>
                                        <small class="text-muted"><?= $row['Kelurahan']; ?>, <?= $row['Kecamatan']; ?>, <?= $row['Kota']; ?></small>
                                    </td>
                                    <td><span class="badge bg-info text-dark">SIM <?= $row['Jenis_SIM']; ?></span></td>
                                    <td><?= $row['Masa_Berlaku']; ?></td>
                                    <td><?= $row['Nama_Satpas']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>