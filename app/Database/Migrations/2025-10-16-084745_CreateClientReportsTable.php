<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientReportsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tanggal_laporan' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'kelurahan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kecamatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kota' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'provinsi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenis_layanan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jadwal_pertemuan' => [
                'type' => 'DATE',
            ],
            'deskripsi_kasus' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('client_reports');
    }

    public function down()
    {
        $this->forge->dropTable('client_reports');
    }
}