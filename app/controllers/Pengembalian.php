<?php

class Pengembalian extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_session']) || $_SESSION['user_session']['role'] != 'admin') {
            Flasher::setFlash('gagal', 'hanya admin yang bisa mengakses pengembalian', 'danger');
            header('Location: ' . BASEURL);
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Data Pengembalian';
        $data['pengembalian'] = $this->model('Pengembalian_model')->getAllPengembalian();
        
        $this->view('templates/header', $data);
        $this->view('pengembalian/index', $data);
        $this->view('templates/footer');
    }

    public function proses($id_pinjam) {
        $data['judul'] = 'Proses Pengembalian';
        $data['pinjam'] = $this->model('Peminjaman_model')->getPeminjamanById($id_pinjam);
        
        $this->view('templates/header', $data);
        $this->view('pengembalian/proses', $data);
        $this->view('templates/footer');
    }

    public function simpan() {
        // Calculate fine for flash message
        $tgl_rencana = new DateTime($_POST['tanggal_kembali_rencana']);
        $tgl_real = new DateTime($_POST['tanggal_dikembalikan']);
        $denda = 0;
        if($tgl_real > $tgl_rencana) {
            $diff = $tgl_real->diff($tgl_rencana);
            $denda = $diff->days * 5000;
        }

        if($this->model('Pengembalian_model')->prosesPengembalian($_POST) > 0) {
            $msg = "Aset dikembalikan tepat waktu.";
            if($denda > 0) {
                $msg = "Aset dikembalikan dengan denda keterlambatan: Rp " . number_format($denda, 0, ',', '.');
            }
            
            $this->model('Log_model')->addLog("Memproses pengembalian peminjaman ID: " . $_POST['id_pinjam'] . ($denda > 0 ? " (Denda: Rp $denda)" : ""));
            Flasher::setFlash('berhasil', $msg, 'success');
            header('Location: ' . BASEURL . '/pengembalian');
            exit;
        } else {
            Flasher::setFlash('gagal', 'memproses pengembalian', 'danger');
            header('Location: ' . BASEURL . '/peminjaman');
            exit;
        }
    }
}
