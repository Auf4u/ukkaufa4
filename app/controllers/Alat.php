<?php
/**
 * DEPLOYMENT_VERSION: 1.0.4 - Fixing Vercel Read-Only FS Issues
 */

class Alat extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_session'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index() {
        if($_SESSION['user_session']['role'] != 'admin') {
            header('Location: ' . BASEURL . '/alat/daftar');
            exit;
        }

        $data['judul'] = 'Daftar Alat';
        
        // Pagination logic
        $limit = 10;
        $page = isset($this->params[0]) ? (int)$this->params[0] : 1;
        if($page < 1) $page = 1;
        $start = ($page - 1) * $limit;
        $total_records = $this->model('Alat_model')->countAlat();
        $data['total_pages'] = ceil($total_records / $limit);
        $data['current_page'] = $page;

        $data['alat'] = $this->model('Alat_model')->getAlatPaginated($start, $limit);
        $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
        
        $this->view('templates/header', $data);
        $this->view('alat/index', $data);
        $this->view('templates/footer');
    }

    public function detail($id) {
        $data['judul'] = 'Detail Alat';
        $data['alat'] = $this->model('Alat_model')->getAlatById($id);
        $this->view('templates/header', $data);
        $this->view('alat/detail', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        ob_start();
        if($_SESSION['user_session']['role'] != 'admin') {
            header('Location: ' . BASEURL . '/alat');
            exit;
        }

        $gambar = 'default.png';
        if(isset($_FILES['gambar']) && $_FILES['gambar']['name'] != '') {
            $namaFile = $_FILES['gambar']['name'];
            $tmpName = $_FILES['gambar']['tmp_name'];
            $error = $_FILES['gambar']['error'];
            
            if($error === 0) {
                $ekstensiGambar = explode('.', $namaFile);
                $ekstensiGambar = strtolower(end($ekstensiGambar));
                $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
                $targetDir = 'img/alat/';
                
                if (is_dir($targetDir) && is_writable($targetDir)) {
                    if(@move_uploaded_file($tmpName, $targetDir . $namaFileBaru)) {
                        $gambar = $namaFileBaru;
                    }
                }
            }
        }

        $_POST['gambar'] = $gambar;

        if($this->model('Alat_model')->tambahDataAlat($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/alat');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/alat');
            exit;
        }
    }

    public function hapus($id) {
        if($_SESSION['user_session']['role'] != 'admin') {
            header('Location: ' . BASEURL . '/alat');
            exit;
        }

        if($this->model('Alat_model')->hapusDataAlat($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/alat');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/alat');
            exit;
        }
    }

    public function getubah() {
        echo json_encode($this->model('Alat_model')->getAlatById($_POST['id']));
    }

    public function ubah() {
        ob_start();
        if($_SESSION['user_session']['role'] != 'admin') {
            header('Location: ' . BASEURL . '/alat');
            exit;
        }

        $alat = $this->model('Alat_model')->getAlatById($_POST['id_alat']);
        $gambarLama = $alat['gambar'];

        if(isset($_FILES['gambar']) && $_FILES['gambar']['name'] != '') {
            $namaFile = $_FILES['gambar']['name'];
            $tmpName = $_FILES['gambar']['tmp_name'];
            $error = $_FILES['gambar']['error'];
            
            if($error === 0) {
                $ekstensiGambar = explode('.', $namaFile);
                $ekstensiGambar = strtolower(end($ekstensiGambar));
                $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
                $targetDir = 'img/alat/';

                if (is_dir($targetDir) && is_writable($targetDir)) {
                    if(@move_uploaded_file($tmpName, $targetDir . $namaFileBaru)) {
                        // delete old image if not default and writable
                        if($gambarLama != 'default.png' && file_exists($targetDir . $gambarLama)) {
                            @unlink($targetDir . $gambarLama);
                        }
                        $_POST['gambar'] = $namaFileBaru;
                    } else {
                        $_POST['gambar'] = $gambarLama;
                    }
                } else {
                    $_POST['gambar'] = $gambarLama;
                }
            } else {
                $_POST['gambar'] = $gambarLama;
            }
        } else {
            $_POST['gambar'] = $gambarLama;
        }

        // Handle the case where no changes are made (0 rows affected) as a success
        if($this->model('Alat_model')->ubahDataAlat($_POST) >= 0) {
            Flasher::setFlash('berhasil', 'diupdate', 'success');
            header('Location: ' . BASEURL . '/alat');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diupdate', 'danger');
            header('Location: ' . BASEURL . '/alat');
            exit;
        }
    }

    public function daftar() {
        $data['judul'] = 'Daftar Alat (Peminjam)';
        $data['alat'] = $this->model('Alat_model')->getAllAlat();
        $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
        $this->view('templates/header', $data);
        $this->view('alat/daftar', $data);
        $this->view('templates/footer');
    }
}
