<?php

namespace App\Controllers;

use App\Models\SimModel;

class SimController extends BaseController
{
    protected $simModel;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->simModel = new SimModel();
        $this->db = \Config\Database::connect();
    }

    // Menampilkan Landing Page / Halaman Depan Utama
    public function home()
    {
        return view('sim/home', [
            'title' => 'Portal Layanan Pendaftaran SIM Online'
        ]);
    }

    public function create()
    {
        $data = [
            'title'   => 'Formulir Pendaftaran SIM Online',
            'wilayah' => $this->db->table('Tabel_Wilayah')->get()->getResultArray(), 
            'satpas'  => $this->db->table('Tabel_Satpas')->get()->getResultArray()   
        ];

        return view('sim/create', $data);
    }

    public function store()
    {
        // 1. Validasi Input & File Foto
        $rules = [
            'nik'            => 'required|exact_length[16]|numeric',
            'nama_pemohon'   => 'required',
            'jalan'          => 'required',
            'rt_rw'          => 'required',
            'id_kelurahan'   => 'required',
            'kode_satpas'    => 'required',
            'pas_foto'       => [
                'uploaded[pas_foto]',
                'is_image[pas_foto]',
                'mime_in[pas_foto,image/jpg,image/jpeg,image/png]',
                'max_size[pas_foto,2048]',
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/create')->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Proses Upload File Foto ke folder public/uploads/pas_foto/
        $fileFoto = $this->request->getFile('pas_foto');
        $namaFotoBaru = '';

        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFotoBaru = $fileFoto->getRandomName(); 
            
            $uploadPath = FCPATH . 'uploads/pas_foto';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $fileFoto->move($uploadPath, $namaFotoBaru);
        }

        $this->db->transStart();

        $idKelurahan    = $this->request->getPost('id_kelurahan');
        $namaKelurahan  = $this->request->getPost('nama_kelurahan');
        $namaKecamatan  = $this->request->getPost('nama_kecamatan');
        $namaKota       = $this->request->getPost('nama_kota');
        $namaProvinsi   = $this->request->getPost('nama_provinsi');

        // Cek / Simpan Wilayah Dinamis
        $cekWilayah = $this->db->table('Tabel_Wilayah')->where('Id_Kelurahan', $idKelurahan)->get()->getRow();
        if (!$cekWilayah) {
            $this->db->table('Tabel_Wilayah')->insert([
                'Id_Kelurahan' => $idKelurahan,
                'Kelurahan'    => $namaKelurahan,
                'Kecamatan'    => $namaKecamatan,
                'Kota'         => $namaKota,
                'Provinsi'     => $namaProvinsi
            ]);
        }

        // 3. Simpan Data Pemohon
        $nik = $this->request->getPost('nik');
        $cekPemohon = $this->db->table('Tabel_Pemohon')->where('NIK', $nik)->get()->getRow();

        if (!$cekPemohon) {
            $this->db->table('Tabel_Pemohon')->insert([
                'NIK'            => $nik,
                'Nama_Pemohon'   => $this->request->getPost('nama_pemohon'),
                'Tempat_Lahir'   => $this->request->getPost('tempat_lahir'),
                'Tanggal_Lahir'  => $this->request->getPost('tanggal_lahir'),
                'Jenis_Kelamin'  => $this->request->getPost('jenis_kelamin'),
                'Golongan_Darah' => $this->request->getPost('golongan_darah'),
                'Pekerjaan'      => $this->request->getPost('pekerjaan') ?: 'Belum/Tidak Bekerja',
                'Jalan'          => $this->request->getPost('jalan'),
                'RT_RW'          => $this->request->getPost('rt_rw'),
                'Pas_Foto'       => $namaFotoBaru,
                'Id_Kelurahan'   => $idKelurahan,
            ]);
        }

        // 4. Simpan Data SIM
        $noSim = 'SIM-' . date('Ymd') . '-' . rand(100, 999);
        $this->db->table('Tabel_SIM')->insert([
            'No_SIM'       => $noSim,
            'NIK'          => $nik,
            'Jenis_SIM'    => $this->request->getPost('jenis_sim') ?? 'A',
            'Masa_Berlaku' => date('Y-m-d', strtotime('+5 years')),
            'Kode_Satpas'  => $this->request->getPost('kode_satpas'),
        ]);

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return redirect()->to('/create')->withInput()->with('error', 'Gagal menyimpan data.');
        }

        // SIMPAN NOMOR SIM KE SESSION SESI USER INI
        session()->set('last_no_sim', $noSim);

        // Langsung arahkan ke halaman bukti pendaftaran pribadi milik user
        return redirect()->to('/sim/bukti/' . $noSim)->with('success', 'Pendaftaran SIM berhasil!');
    }

    public function lihatData()
    {
        $noSim = session()->get('last_no_sim');

        if (!$noSim) {
            return redirect()->to('/')->with('error', 'Belum ada data pendaftaran yang ditemukan pada sesi ini. Silakan isi formulir terlebih dahulu.');
        }

        return redirect()->to('/sim/bukti/' . $noSim);
    }

    // Menampilkan halaman form input NIK untuk user
    public function cariForm()
    {
        return view('sim/cari', [
            'title' => 'Cek Data Pendaftaran SIM'
        ]);
    }

    // Memproses NIK yang dimasukkan oleh user
    public function cariProses()
    {
        $nik = $this->request->getPost('nik');

        if (empty($nik) || strlen(trim($nik)) !== 16) {
            return redirect()->back()->with('error', 'Masukkan 16 digit NIK yang valid!');
        }

        $pendaftaran = $this->simModel
            ->join('Tabel_Pemohon', 'Tabel_Pemohon.NIK = Tabel_SIM.NIK')
            ->join('Tabel_Wilayah', 'Tabel_Wilayah.Id_Kelurahan = Tabel_Pemohon.Id_Kelurahan')
            ->join('Tabel_Satpas', 'Tabel_Satpas.Kode_Satpas = Tabel_SIM.Kode_Satpas')
            ->where('Tabel_Pemohon.NIK', $nik)
            ->orderBy('Tabel_SIM.No_SIM', 'DESC')
            ->first();

        if (!$pendaftaran) {
            return redirect()->back()->with('error', 'Data pendaftaran dengan NIK tersebut tidak ditemukan.');
        }

        return redirect()->to('/sim/bukti/' . $pendaftaran['No_SIM']);
    }

    public function bukti($noSim)
    {
        $pendaftaran = $this->simModel->where('Tabel_SIM.No_SIM', $noSim)
            ->join('Tabel_Pemohon', 'Tabel_Pemohon.NIK = Tabel_SIM.NIK')
            ->join('Tabel_Wilayah', 'Tabel_Wilayah.Id_Kelurahan = Tabel_Pemohon.Id_Kelurahan')
            ->join('Tabel_Satpas', 'Tabel_Satpas.Kode_Satpas = Tabel_SIM.Kode_Satpas')
            ->first();

        if (!$pendaftaran) {
            return redirect()->to('/create')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $data = [
            'title' => 'Tanda Bukti Pendaftaran SIM',
            'row'   => $pendaftaran
        ];

        return view('sim/bukti', $data);
    }

    
}