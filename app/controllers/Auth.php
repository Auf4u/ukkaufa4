<?php

class Auth extends Controller {
    public function index() {
        if(isset($_SESSION['user_session'])) {
            header('Location: ' . BASEURL);
            exit;
        }
        $data['judul'] = 'Login';
        $this->view('auth/login', $data);
    }

    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->model('User_model')->getUserByUsername($username);

        if($user) {
            if($user['password_md5'] == md5($password)) {
                if($user['status'] == 'aktif') {
                    $_SESSION['user_session'] = $user;
                    $this->model('Log_model')->addLog("User login ke sistem");
                    Flasher::setFlash('Login Berhasil', 'Selamat datang di LabApp Pro, ' . $user['nama_lengkap'], 'success');
                    header('Location: ' . BASEURL);
                    exit;
                } else {
                    Flasher::setFlash('Akses Ditolak', 'Akun Anda sedang dinonaktifkan. Silakan hubungi admin.', 'error');
                    header('Location: ' . BASEURL . '/auth');
                    exit;
                }
            } else {
                Flasher::setFlash('Login Gagal', 'Password yang Anda masukkan salah.', 'error');
                header('Location: ' . BASEURL . '/auth');
                exit;
            }
        } else {
            Flasher::setFlash('Login Gagal', 'Username tidak ditemukan.', 'error');
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function logout() {
        $this->model('Log_model')->addLog("User logout dari sistem");
        
        session_unset();
        session_destroy();
        
        // Start a fresh session just for the flash message
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        Flasher::setFlash('Berhasil Logout', 'Anda telah keluar dari sistem', 'success');
        
        header('Location: ' . BASEURL . '/auth');
        exit;
    }
}
