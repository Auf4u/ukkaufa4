<?php

class Alat_model {
    private $table = 'alat';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllAlat() {
        $this->db->query('SELECT alat.*, kategori.nama_kategori FROM ' . $this->table . ' JOIN kategori ON alat.id_kategori = kategori.id_kategori');
        return $this->db->resultSet();
    }

    public function getAlatPaginated($start, $limit) {
        $this->db->query('SELECT alat.*, kategori.nama_kategori FROM ' . $this->table . ' JOIN kategori ON alat.id_kategori = kategori.id_kategori LIMIT :start, :limit');
        $this->db->bind('start', (int)$start, PDO::PARAM_INT);
        $this->db->bind('limit', (int)$limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countAlat() {
        $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        $res = $this->db->single();
        return $res['total'];
    }

    public function getAlatById($id) {
        $this->db->query('SELECT alat.*, kategori.nama_kategori FROM ' . $this->table . ' JOIN kategori ON alat.id_kategori = kategori.id_kategori WHERE id_alat=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataAlat($data) {
        $query = "INSERT INTO alat (nama_alat, id_kategori, stok, kondisi, deskripsi, gambar)
                    VALUES
                  (:nama_alat, :id_kategori, :stok, :kondisi, :deskripsi, :gambar)";
        
        $this->db->query($query);
        $this->db->bind('nama_alat', $data['nama_alat']);
        $this->db->bind('id_kategori', $data['id_kategori']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('kondisi', $data['kondisi']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->bind('gambar', $data['gambar']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataAlat($id) {
        $query = "DELETE FROM alat WHERE id_alat = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahDataAlat($data) {
        $query = "UPDATE alat SET
                    nama_alat = :nama_alat,
                    id_kategori = :id_kategori,
                    stok = :stok,
                    kondisi = :kondisi,
                    deskripsi = :deskripsi,
                    gambar = :gambar
                  WHERE id_alat = :id_alat";
        
        $this->db->query($query);
        $this->db->bind('nama_alat', $data['nama_alat']);
        $this->db->bind('id_kategori', $data['id_kategori']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('kondisi', $data['kondisi']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->bind('gambar', $data['gambar']);
        $this->db->bind('id_alat', $data['id_alat']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cariDataAlat() {
        $keyword = $_POST['keyword'];
        $query = "SELECT alat.*, kategori.nama_kategori FROM alat JOIN kategori ON alat.id_kategori = kategori.id_kategori WHERE nama_alat LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }
}
