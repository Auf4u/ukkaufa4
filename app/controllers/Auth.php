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
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        if (empty($username) || empty($password)) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                Flasher::setFlash('Login Gagal', 'Username dan Password tidak boleh kosong.', 'error');
            }
            header('Location: ' . BASEURL . '/auth');
            exit;
        }

        $user = $this->model('User_model')->getUserByUsername($username);

        if($user) {
            if($user['password_md5'] === md5($password)) {
                if($user['status'] == 'aktif') {
                    $_SESSION['user_session'] = $user;
                    $this->model('Log_model')->addLog("User login ke sistem");
                    
                    // Debug info
                    $db_host = DB_HOST;
                    $env = (strpos($db_host, 'aivencloud.com') !== false) ? 'Produksi (Aiven)' : 'Lokal (Development)';
                    $debug_msg = "Selamat datang kembali, " . $user['nama_lengkap'] . "! [DEBUG: Host=$db_host | Env=$env]";
                    
                    Flasher::setFlash('Login Berhasil', $debug_msg, 'success');
                    
                    session_write_close();
                    header('Location: ' . BASEURL);
                    exit;
                } else {
                    Flasher::setFlash('Akses Ditolak', 'Akun Anda sedang dinonaktifkan. Silakan hubungi administrator.', 'warning');
                    header('Location: ' . BASEURL . '/auth');
                    exit;
                }
            } else {
                Flasher::setFlash('Password Salah', 'Maaf, password yang Anda masukkan tidak sesuai.', 'error');
                header('Location: ' . BASEURL . '/auth');
                exit;
            }
        } else {
            Flasher::setFlash('User Tidak Ada', 'Username tersebut belum terdaftar dalam sistem kami.', 'error');
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function logout() {
        if(isset($_SESSION['user_session'])) {
            $this->model('Log_model')->addLog("User logout dari sistem");
            unset($_SESSION['user_session']);
        }
        
        Flasher::setFlash('Berhasil Keluar', 'Anda telah aman keluar dari sistem. Sampai jumpa lagi!', 'success');
        session_write_close();
        header('Location: ' . BASEURL . '/auth');
        exit;
    }
}
