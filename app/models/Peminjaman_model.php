<?php

class Peminjaman_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllPeminjaman() {
        $query = "SELECT peminjaman.*, users.nama_lengkap, alat.nama_alat 
                  FROM peminjaman 
                  JOIN users ON peminjaman.id_user = users.id_user 
                  LEFT JOIN detail_peminjaman ON peminjaman.id_pinjam = detail_peminjaman.id_pinjam
                  LEFT JOIN alat ON detail_peminjaman.id_alat = alat.id_alat
                  ORDER BY tanggal_pinjam DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getRiwayatPeminjaman($id_user) {
        $query = "SELECT peminjaman.*, alat.nama_alat 
                  FROM peminjaman 
                  LEFT JOIN detail_peminjaman ON peminjaman.id_pinjam = detail_peminjaman.id_pinjam
                  LEFT JOIN alat ON detail_peminjaman.id_alat = alat.id_alat
                  WHERE peminjaman.id_user = :id_user 
                  ORDER BY tanggal_pinjam DESC";
        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }

    public function getDetailPeminjaman($id_pinjam) {
        $query = "SELECT detail_peminjaman.*, alat.nama_alat, alat.kondisi, alat.gambar 
                  FROM detail_peminjaman 
                  JOIN alat ON detail_peminjaman.id_alat = alat.id_alat 
                  WHERE id_pinjam = :id_pinjam";
        $this->db->query($query);
        $this->db->bind('id_pinjam', $id_pinjam);
        return $this->db->resultSet();
    }

    public function getPeminjamanById($id) {
        $this->db->query('SELECT * FROM peminjaman WHERE id_pinjam = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function ajukanPeminjaman($data) {
        try {
            // 1. Insert into peminjaman
            $query = "INSERT INTO peminjaman (id_user, tanggal_pinjam, tanggal_kembali_rencana, status, gambar_bukti) 
                      VALUES (:id_user, :tgl_pinjam, :tgl_kembali, 'menunggu', :gambar_bukti)";
            $this->db->query($query);
            $this->db->bind('id_user', $_SESSION['user_session']['id_user']);
            $this->db->bind('tgl_pinjam', $data['tanggal_pinjam']);
            $this->db->bind('tgl_kembali', $data['tanggal_kembali_rencana']);
            $this->db->bind('gambar_bukti', $data['gambar_bukti']);
            $this->db->execute();

            $id_pinjam = $this->db->lastInsertId();

            // 2. Insert into detail_peminjaman
            $queryDetail = "INSERT INTO detail_peminjaman (id_pinjam, id_alat, jumlah) 
                           VALUES (:id_pinjam, :id_alat, :jumlah)";
            $this->db->query($queryDetail);
            $this->db->bind('id_pinjam', $id_pinjam);
            $this->db->bind('id_alat', $data['id_alat']);
            $this->db->bind('jumlah', $data['jumlah']);
            $this->db->execute();

            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateStatus($id_pinjam, $status) {
        $query = "UPDATE peminjaman SET status = :status WHERE id_pinjam = :id_pinjam";
        $this->db->query($query);
        $this->db->bind('status', $status);
        $this->db->bind('id_pinjam', $id_pinjam);
        $this->db->execute();
        $rowCountStatus = $this->db->rowCount();

        // If approved, reduce stock
        if($status == 'disetujui' && $rowCountStatus > 0) {
            $details = $this->getDetailPeminjaman($id_pinjam);
            foreach($details as $d) {
                $this->db->query("UPDATE alat SET stok = stok - :jumlah WHERE id_alat = :id_alat");
                $this->db->bind('jumlah', $d['jumlah']);
                $this->db->bind('id_alat', $d['id_alat']);
                $this->db->execute();
            }
        }

        return $rowCountStatus;
    }
    public function batalPeminjaman($id) {
        // Only allow cancel if status is still 'menunggu'
        $this->db->query("SELECT status FROM peminjaman WHERE id_pinjam = :id");
        $this->db->bind('id', $id);
        $pinjam = $this->db->single();

        if($pinjam && $pinjam['status'] == 'menunggu') {
            $this->db->query("DELETE FROM peminjaman WHERE id_pinjam = :id");
            $this->db->bind('id', $id);
            $this->db->execute();
            return $this->db->rowCount();
        }
        return 0;
    }
}
