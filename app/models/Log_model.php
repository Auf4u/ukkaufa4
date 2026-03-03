<?php

class Log_model {
    private $table = 'log_aktivitas';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function addLog($aktivitas) {
        if(!isset($_SESSION['user_session'])) return 0;
        
        $id_user = $_SESSION['user_session']['id_user'];
        $query = "INSERT INTO log_aktivitas (id_user, aktivitas, tanggal) VALUES (:id_user, :aktivitas, NOW())";
        
        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        $this->db->bind('aktivitas', $aktivitas);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getAllLogs() {
        $query = "SELECT log_aktivitas.*, users.username 
                  FROM log_aktivitas 
                  JOIN users ON log_aktivitas.id_user = users.id_user 
                  ORDER BY tanggal DESC LIMIT 100";
        $this->db->query($query);
        return $this->db->resultSet();
    }
}
