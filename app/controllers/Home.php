<?php

class Home extends Controller {
    public function index() {
        if(!isset($_SESSION['user_session'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }

        $data['judul'] = 'Dashboard';
        $data['user'] = $_SESSION['user_session'];
        
        // Fetch stats for dashboard
        $data['count_alat'] = count($this->model('Alat_model')->getAllAlat());
        $data['count_user'] = count($this->model('User_model')->getAllUsers());
        $data['total_denda'] = $this->model('Pengembalian_model')->getTotalDenda() ?? 0;
        
        $peminjaman = $this->model('Peminjaman_model')->getAllPeminjaman();
        $data['count_pinjam_pending'] = 0;
        $data['count_pinjam_disetujui'] = 0;
        foreach($peminjaman as $p) {
            if($p['status'] == 'menunggu') $data['count_pinjam_pending']++;
            if($p['status'] == 'disetujui') $data['count_pinjam_disetujui']++;
        }
        
        // Fetch recent activities
        $data['recent_logs'] = array_slice($this->model('Log_model')->getAllLogs(), 0, 5);
        
        // Load appropriate dashboard based on role
        if($data['user']['role'] == 'admin') {
            $this->view('templates/header', $data);
            $this->view('admin/dashboard', $data);
            $this->view('templates/footer');
        } elseif($data['user']['role'] == 'petugas') {
            $this->view('templates/header', $data);
            $this->view('petugas/dashboard', $data);
            $this->view('templates/footer');
        } else {
            $this->view('templates/header', $data);
            $this->view('peminjam/dashboard', $data);
            $this->view('templates/footer');
        }
    }
}
