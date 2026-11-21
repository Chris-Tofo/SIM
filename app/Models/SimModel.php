<?php

namespace App\Models;

use CodeIgniter\Model;

class SimModel extends Model
{
    protected $table = 'Tabel_SIM';
    protected $primaryKey = 'No_SIM';
    protected $allowedFields = ['No_SIM', 'NIK', 'Jenis_SIM', 'Masa_Berlaku', 'Kode_Satpas'];

    // Mengambil seluruh data dengan menggabungkan (JOIN) tabel-tabel 3NF
    public function getAllPendaftaran()
    {
        return $this->db->table('Tabel_SIM')
            ->select('Tabel_SIM.*, Tabel_Pemohon.*, Tabel_Wilayah.*, Tabel_Satpas.*')
            ->join('Tabel_Pemohon', 'Tabel_Pemohon.NIK = Tabel_SIM.NIK')
            ->join('Tabel_Wilayah', 'Tabel_Wilayah.Id_Kelurahan = Tabel_Pemohon.Id_Kelurahan')
            ->join('Tabel_Satpas', 'Tabel_Satpas.Kode_Satpas = Tabel_SIM.Kode_Satpas')
            ->orderBy('Tabel_SIM.No_SIM', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getWilayahList()
    {
        return $this->db->table('Tabel_Wilayah')->get()->getResultArray();
    }

    public function getSatpasList()
    {
        return $this->db->table('Tabel_Satpas')->get()->getResultArray();
    }
}