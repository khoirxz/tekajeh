<?php
class Input {

    function __construct() {
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', 'root');
        define('DBNAME', 'belajar');

        $this->db = new mysqli(HOST, USER, PASS, DBNAME);
    }

    function addUser($nama, $alamat) {

        $sql = "INSERT INTO users(nama, alamat) VALUES(?, ?)";
        $prepare = $this->db->prepare($sql);
        $prepare->bind_param('ss', $nama, $alamat);
        // $query = $conn->query($sql);
        $prepare->execute();

    }

    function showUser() {

        $sql = "SELECT * FROM users";
        $result = $this->db->query($sql);
        return $result;
    }

    function editUser($id) {

        $sql = "SELECT * FROM users WHERE id = '$id'";
        $query = $this->db->query($sql);
        return $query;
    }

    function updateUser($id, $nama, $alamat) {

        $sql = "UPDATE users SET nama = '$nama', alamat = '$alamat' WHERE id = '$id'";
        $result = $this->db->query($sql);
        
        if(!$result) {

            return "gagal";
        } else {

            return "sukses";
        }
    }

    function deleteUser($id) {
        
        $sql = "DELETE FROM `users` WHERE `users`.`id` = $id";
        $result = $this->db->query($sql);
    }
}