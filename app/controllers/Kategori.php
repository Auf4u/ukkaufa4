<?php

class Kategori extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_session']) || $_SESSION['user_session']['role'] != 'admin') {
            header('Location: ' . BASEURL);
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Daftar Kategori';
        $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
        $this->view('templates/header', $data);
        $this->view('kategori/index', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if($this->model('Kategori_model')->tambahDataKategori($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/kategori');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/kategori');
            exit;
        }
    }

    public function hapus($id) {
        if($this->model('Kategori_model')->hapusDataKategori($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/kategori');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/kategori');
            exit;
        }
    }

    public function getubah() {
        echo json_encode($this->model('Kategori_model')->getKategoriById($_POST['id']));
    }

    public function ubah() {
        if($this->model('Kategori_model')->ubahDataKategori($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
        } else {
            Flasher::setFlash('gagal atau tidak ada perubahan', 'diubah', 'danger');
        }
        header('Location: ' . BASEURL . '/kategori');
        exit;
    }
}
