<?php

class Peminjaman extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_session'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index() {
        $role = $_SESSION['user_session']['role'];
        if($role != 'petugas') {
            if($role == 'peminjam') {
                header('Location: ' . BASEURL . '/peminjaman/riwayat');
            } else {
                header('Location: ' . BASEURL);
            }
            exit;
        }

        $data['judul'] = 'Data Peminjaman';
        $data['peminjaman'] = $this->model('Peminjaman_model')->getAllPeminjaman();
        
        $this->view('templates/header', $data);
        $this->view('peminjaman/index', $data);
        $this->view('templates/footer');
    }

    public function riwayat() {
        $data['judul'] = 'Riwayat Peminjaman Saya';
        $data['peminjaman'] = $this->model('Peminjaman_model')->getRiwayatPeminjaman($_SESSION['user_session']['id_user']);
        
        $this->view('templates/header', $data);
        $this->view('peminjaman/riwayat', $data);
        $this->view('templates/footer');
    }

    public function ajukan($id_alat) {
        $data['judul'] = 'Ajukan Peminjaman';
        $data['alat'] = $this->model('Alat_model')->getAlatById($id_alat);
        
        $this->view('templates/header', $data);
        $this->view('peminjaman/ajukan', $data);
        $this->view('templates/footer');
    }

    public function proses_ajukan() {
        $gambar = 'default_bukti.png';
        if(isset($_FILES['gambar_bukti']) && $_FILES['gambar_bukti']['name'] != '') {
            $namaFile = $_FILES['gambar_bukti']['name'];
            $tmpName = $_FILES['gambar_bukti']['tmp_name'];
            $error = $_FILES['gambar_bukti']['error'];
            
            if($error === 0) {
                $ekstensiGambar = explode('.', $namaFile);
                $ekstensiGambar = strtolower(end($ekstensiGambar));
                $namaFileBaru = 'bukti_' . uniqid() . '.' . $ekstensiGambar;
                
                // Ensure directory exists relative to public/
                $targetDir = 'img/peminjaman/';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                
                move_uploaded_file($tmpName, $targetDir . $namaFileBaru);
                $gambar = $namaFileBaru;
            }
        }

        $_POST['gambar_bukti'] = $gambar;

        if($this->model('Peminjaman_model')->ajukanPeminjaman($_POST) > 0) {
            $this->model('Log_model')->addLog("Mengajukan peminjaman alat ID: " . $_POST['id_alat']);
            Flasher::setFlash('berhasil', 'diajukan, menunggu persetujuan petugas', 'success');
            header('Location: ' . BASEURL . '/peminjaman/riwayat');
            exit;
        } else {
            Flasher::setFlash('gagal', 'mengajukan peminjaman', 'danger');
            header('Location: ' . BASEURL . '/alat/daftar');
            exit;
        }
    }

    public function setujui($id) {
        if($_SESSION['user_session']['role'] != 'petugas') {
            Flasher::setFlash('gagal', 'hanya petugas yang bisa menyetujui', 'danger');
            header('Location: ' . BASEURL);
            exit;
        }
        
        if($this->model('Peminjaman_model')->updateStatus($id, 'disetujui') > 0) {
            $this->model('Log_model')->addLog("Menyetujui peminjaman ID: " . $id);
            Flasher::setFlash('berhasil', 'disetujui, stok alat otomatis berkurang', 'success');
            header('Location: ' . BASEURL . '/peminjaman');
            exit;
        }
    }

    public function tolak($id) {
        if($_SESSION['user_session']['role'] != 'petugas') {
            Flasher::setFlash('gagal', 'hanya petugas yang bisa menolak', 'danger');
            header('Location: ' . BASEURL);
            exit;
        }

        if($this->model('Peminjaman_model')->updateStatus($id, 'ditolak') > 0) {
            $this->model('Log_model')->addLog("Menolak peminjaman ID: " . $id);
            Flasher::setFlash('berhasil', 'ditolak', 'info');
            header('Location: ' . BASEURL . '/peminjaman');
            exit;
        }
    }

    public function batal($id) {
        if($this->model('Peminjaman_model')->batalPeminjaman($id) > 0) {
            $this->model('Log_model')->addLog("Membatalkan peminjaman ID: " . $id);
            Flasher::setFlash('berhasil', 'peminjaman dibatalkan', 'info');
        } else {
            Flasher::setFlash('gagal', 'peminjaman tidak bisa dibatalkan', 'danger');
        }
        header('Location: ' . BASEURL . '/peminjaman/riwayat');
        exit;
    }

    public function detail($id) {
        $data['judul'] = 'Detail Peminjaman';
        $data['pinjam'] = $this->model('Peminjaman_model')->getPeminjamanById($id);
        $data['detail'] = $this->model('Peminjaman_model')->getDetailPeminjaman($id);
        
        $this->view('templates/header', $data);
        $this->view('peminjaman/detail', $data);
        $this->view('templates/footer');
    }
}
