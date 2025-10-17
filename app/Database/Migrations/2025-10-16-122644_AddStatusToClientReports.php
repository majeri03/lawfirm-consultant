<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusToClientReports extends Migration
{
    public function up()
    {
        $this->forge->addColumn('client_reports', [
            'status' => [
                'type'       => "ENUM('Baru Masuk', 'Sudah Dihubungi', 'Jadwal Ulang', 'Kasus Diterima', 'Ditolak')",
                'default'    => 'Baru Masuk',
                'after'      => 'deskripsi_kasus', // diletakkan setelah kolom deskripsi
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('client_reports', 'status');
    }
}