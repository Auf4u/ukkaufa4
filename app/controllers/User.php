<?php

class User extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_session']) || $_SESSION['user_session']['role'] != 'admin') {
            header('Location: ' . BASEURL);
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Manajemen User';
        $data['users'] = $this->model('User_model')->getAllUsers();
        $this->view('templates/header', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if($this->model('User_model')->addUser($_POST) > 0) {
            $this->model('Log_model')->addLog("Menambahkan user baru: " . $_POST['username']);
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }

    public function hapus($id) {
        $user = $this->model('User_model')->getUserById($id);
        if($this->model('User_model')->deleteUser($id) > 0) {
            $this->model('Log_model')->addLog("Menghapus user: " . $user['username']);
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }

    public function getubah() {
        echo json_encode($this->model('User_model')->getUserById($_POST['id']));
    }

    public function ubah() {
        if($this->model('User_model')->updateUser($_POST) > 0) {
            $this->model('Log_model')->addLog("Mengubah data user ID: " . $_POST['id_user']);
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }
}
