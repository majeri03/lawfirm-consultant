<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientReportModel extends Model
{
    protected $table            = 'client_reports';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tanggal_laporan',
        'nama_lengkap',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'no_hp',
        'email',
        'jenis_layanan',
        'jadwal_pertemuan',
        'deskripsi_kasus',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}