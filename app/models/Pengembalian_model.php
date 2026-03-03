<?php

class Pengembalian_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllPengembalian() {
        $query = "SELECT pengembalian.*, users.nama_lengkap, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali_rencana 
                  FROM pengembalian 
                  JOIN peminjaman ON pengembalian.id_pinjam = peminjaman.id_pinjam 
                  JOIN users ON peminjaman.id_user = users.id_user 
                  ORDER BY tanggal_dikembalikan DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getTotalDenda() {
        $this->db->query('SELECT SUM(denda) as total FROM pengembalian');
        return $this->db->single()['total'];
    }

    public function prosesPengembalian($data) {
        try {
            // 1. Hitung denda jika ada
            $tgl_kembali_rencana = new DateTime($data['tanggal_kembali_rencana']);
            $tgl_dikembalikan = new DateTime($data['tanggal_dikembalikan']);
            $denda = 0;
            
            if($tgl_dikembalikan > $tgl_kembali_rencana) {
                $selisih = $tgl_dikembalikan->diff($tgl_kembali_rencana);
                $hari = $selisih->days;
                $denda = $hari * 5000; // Misal denda 5000 per hari
            }

            // 2. Insert into pengembalian
            $query = "INSERT INTO pengembalian (id_pinjam, tanggal_dikembalikan, denda, kondisi_akhir) 
                      VALUES (:id_pinjam, :tgl_dikembalikan, :denda, :kondisi)";
            $this->db->query($query);
            $this->db->bind('id_pinjam', $data['id_pinjam']);
            $this->db->bind('tgl_dikembalikan', $data['tanggal_dikembalikan']);
            $this->db->bind('denda', $denda);
            $this->db->bind('kondisi', $data['kondisi_akhir']);
            $this->db->execute();

            // 3. Update status peminjaman
            $this->db->query("UPDATE peminjaman SET status = 'kembali' WHERE id_pinjam = :id_pinjam");
            $this->db->bind('id_pinjam', $data['id_pinjam']);
            $this->db->execute();

            // 4. Kembalikan stok alat
            // Get details first
            $this->db->query("SELECT * FROM detail_peminjaman WHERE id_pinjam = :id_pinjam");
            $this->db->bind('id_pinjam', $data['id_pinjam']);
            $details = $this->db->resultSet();

            foreach($details as $d) {
                $this->db->query("UPDATE alat SET stok = stok + :jumlah WHERE id_alat = :id_alat");
                $this->db->bind('jumlah', $d['jumlah']);
                $this->db->bind('id_alat', $d['id_alat']);
                $this->db->execute();
            }

            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }
}
