<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $session;
    public function __construct()
    {
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
    }

    // Menampilkan halaman login/register
    public function index()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('auth');
    }

    // Proses registrasi
    public function register()
    {
        $rules = [
            'nama_lengkap'    => 'required|min_length[3]|max_length[255]',
            'email'           => 'required|valid_email|is_unique[users.email]',
            'nomor_handphone' => 'required|numeric|min_length[10]|max_length[15]',
            'password'        => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
            'tanggal_lahir'   => 'required',
            'jenis_kelamin'   => 'required',
            'provinsi'        => 'required', 
            'kota'            => 'required'  
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'nama_lengkap'    => $this->request->getVar('nama_lengkap'),
                'email'           => $this->request->getVar('email'),
                'nomor_handphone' => $this->request->getVar('nomor_handphone'),
                'password'        => $this->request->getVar('password'),
                'tanggal_lahir'   => $this->request->getVar('tanggal_lahir'),
                'jenis_kelamin'   => $this->request->getVar('jenis_kelamin'),
                'kota'            => $this->request->getVar('kota')
            ];

            $model->save($data);
            
            $this->session->setFlashdata('success', 'Registrasi berhasil! Silakan login.');
            return redirect()->to('/login');

        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    // Proses login
    public function login()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $user = $model->where('email', $this->request->getVar('email'))->first();

            if ($user && password_verify($this->request->getVar('password'), $user['password'])) {
                // Set session
                $sessionData = [
                    'user_id'       => $user['id'],
                    'nama_lengkap'  => $user['nama_lengkap'],
                    'email'         => $user['email'],
                    'isLoggedIn'    => true,
                    'role'          => $user['role'],
                ];
                $this->session->set($sessionData);

                if ($user['role'] === 'admin') {
                    return redirect()->to('/admin');
                }
                return redirect()->to('/dashboard');
            } else {
                $this->session->setFlashdata('error', 'Email atau password salah.');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    // Halaman dashboard yang dilindungi
    public function dashboard()
    {
        return view('dashboard');
    }

    // Proses logout
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }

    public function profile()
    {
        $model = new UserModel();
        $userId = session()->get('user_id');
        $data['user'] = $model->find($userId);

        // Tampilkan view profile.php dan kirim data user ke dalamnya
        return view('profile', $data);
    }
    public function contact()
    {
        // Fungsi ini hanya akan memuat view untuk halaman kontak di dashboard
        return view('contact_dashboard');
    }

    public function report()
    {
        helper(['form']);
        return view('report_form_dashboard'); // Kita akan buat view baru yg sesuai
    }
}
