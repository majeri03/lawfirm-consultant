<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientReportModel;

class ReportController extends BaseController
{
    public function index()
    {
        helper(['form']);
        echo view('templates/header');
        echo view('report_form');
        echo view('templates/footer');
    }

    public function save()
    {
        helper(['form']);
        $rules = [
            'nama_lengkap'    => 'required|min_length[3]|max_length[255]',
            'alamat'          => 'required',
            'provinsi'        => 'required',
            'kota'            => 'required',
            'kecamatan'       => 'required',
            'kelurahan'       => 'required',
            'no_hp'           => 'required|numeric|min_length[10]|max_length[15]',
            'email'           => 'required|valid_email',
            'jenis_layanan'   => 'required',
            'jadwal_pertemuan' => 'required',
            'deskripsi_kasus' => 'required',
        ];

        if ($this->validate($rules)) {
            $model = new ClientReportModel();
            $data = [
                'nama_lengkap'     => $this->request->getVar('nama_lengkap'),
                'alamat'           => $this->request->getVar('alamat'),
                'provinsi'         => $this->request->getVar('provinsi'),
                'kota'             => $this->request->getVar('kota'),
                'kecamatan'        => $this->request->getVar('kecamatan'),
                'kelurahan'        => $this->request->getVar('kelurahan'),
                'no_hp'            => $this->request->getVar('no_hp'),
                'email'            => $this->request->getVar('email'),
                'jenis_layanan'    => $this->request->getVar('jenis_layanan'),
                'jadwal_pertemuan' => $this->request->getVar('jadwal_pertemuan'),
                'deskripsi_kasus'  => $this->request->getVar('deskripsi_kasus'),
                'tanggal_laporan'  => date('Y-m-d H:i:s'),
            ];
            $model->save($data);
            return redirect()->back()->with('success', 'Laporan Anda telah berhasil dikirim.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }
}