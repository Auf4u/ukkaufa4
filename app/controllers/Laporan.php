<?php

class Laporan extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_session'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index() {
        if($_SESSION['user_session']['role'] != 'petugas') {
            Flasher::setFlash('gagal', 'hanya petugas yang bisa mengecek laporan', 'danger');
            header('Location: ' . BASEURL);
            exit;
        }
        $data['judul'] = 'Cetak Laporan';
        // Get some stats
        $data['total_pinjaman'] = count($this->model('Peminjaman_model')->getAllPeminjaman());
        $data['total_kembali'] = count($this->model('Pengembalian_model')->getAllPengembalian());
        
        $this->view('templates/header', $data);
        $this->view('laporan/index', $data);
        $this->view('templates/footer');
    }

    public function generate($type) {
        if($_SESSION['user_session']['role'] != 'petugas') {
            header('Location: ' . BASEURL);
            exit;
        }
        if($type == 'peminjaman') {
            $data['laporan'] = $this->model('Peminjaman_model')->getAllPeminjaman();
            $data['judul'] = 'Laporan Peminjaman Alat';
        } else {
            $data['laporan'] = $this->model('Pengembalian_model')->getAllPengembalian();
            $data['judul'] = 'Laporan Pengembalian Alat';
        }
        
        // Use a simple print-friendly view
        $this->view('laporan/print', $data);
    }

    public function logs() {
        if($_SESSION['user_session']['role'] != 'admin') exit;
        
        $data['judul'] = 'Log Aktivitas';
        $data['logs'] = $this->model('Log_model')->getAllLogs();
        
        $this->view('templates/header', $data);
        $this->view('laporan/logs', $data);
        $this->view('templates/footer');
    }
}
