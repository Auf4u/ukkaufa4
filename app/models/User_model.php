<?php

class User_model {
    private $table = 'users';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getUserByUsername($username) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username=:username');
        $this->db->bind('username', $username);
        return $this->db->single();
    }
    
    public function getAllUsers() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function addUser($data) {
        $query = "INSERT INTO users (username, password_md5, nama_lengkap, role, status)
                  VALUES (:username, :password, :nama, :role, :status)";
        
        $this->db->query($query);
        $this->db->bind('username', $data['username'] ?? '');
        $this->db->bind('password', md5($data['password'] ?? '')); // MD5 as required
        $this->db->bind('nama', $data['nama'] ?? '');
        $this->db->bind('role', $data['role'] ?? 'peminjam');
        $this->db->bind('status', 'aktif');

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getUserById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_user=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function updateUser($data) {
        $query = "UPDATE users SET 
                    username = :username, 
                    nama_lengkap = :nama, 
                    role = :role, 
                    status = :status";
        
        // Only update password if provided
        if(!empty($data['password'])) {
            $query .= ", password_md5 = :password";
        }
        
        $query .= " WHERE id_user = :id";
        
        $this->db->query($query);
        $this->db->bind('username', $data['username'] ?? '');
        $this->db->bind('nama', $data['nama'] ?? '');
        $this->db->bind('role', $data['role'] ?? 'peminjam');
        $this->db->bind('status', $data['status'] ?? 'aktif');
        $this->db->bind('id', $data['id_user'] ?? 0);
        
        if(!empty($data['password'])) {
            $this->db->bind('password', md5($data['password']));
        }

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id_user = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
