<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientReportModel; // Tambahkan ini

class AdminController extends BaseController
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }
    public function getReports()
    {
        if ($this->request->isAJAX()) {
            $model = new ClientReportModel();

            $data = $model->orderBy('created_at', 'DESC')->findAll();

            return $this->response->setJSON([
            'data'      => $data,
            'csrf_hash' => csrf_hash()
            ]);
        }

        return $this->response->setStatusCode(403, 'Forbidden');
    }
    /**
     * Menghapus laporan klien berdasarkan ID.
     */
    public function deleteReport($id = null)
    {
        if ($this->request->isAJAX()) {
            $model = new ClientReportModel();

            $report = $model->find($id);

            if ($report) {
                $model->delete($id);

                return $this->response->setJSON(['status' => 'success', 'message' => 'Laporan berhasil dihapus.', 'csrf_hash' => csrf_hash()]);
            }

            return $this->response->setStatusCode(404)->setJSON(['status' => 'error', 'message' => 'Laporan tidak ditemukan.']);
        }

        return $this->response->setStatusCode(403, 'Forbidden');
    }

    /**
     * Mengambil detail satu laporan berdasarkan ID dan mengembalikannya sebagai JSON.
     */
    public function viewReport($id = null)
    {
        if ($this->request->isAJAX()) {
            $model = new ClientReportModel();
            $report = $model->find($id);

            if ($report) {
                return $this->response->setJSON([
                    'data'      => $report,
                    'csrf_hash' => csrf_hash()
                ]);
            }
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Laporan tidak ditemukan.', 'csrf_hash' => csrf_hash()]);
        }
        return $this->response->setStatusCode(403, 'Forbidden');
    }

    /**
     * Memperbarui status laporan.
     */
    public function updateStatus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('report_id');
            $status = $this->request->getVar('status');

            $rules = [
                'report_id' => 'required|numeric',
                'status'    => 'required|in_list[Baru Masuk,Sudah Dihubungi,Jadwal Ulang,Kasus Diterima,Ditolak]'
            ];

            if (!$this->validate($rules)) {
                return $this->response->setStatusCode(400)->setJSON(['message' => 'Data tidak valid.']);
            }

            $model = new ClientReportModel();
            
            if ($model->update($id, ['status' => $status])) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Status berhasil diperbarui.']);
            }
            
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Gagal memperbarui status.']);
        }
        return $this->response->setStatusCode(403, 'Forbidden');
    }
}