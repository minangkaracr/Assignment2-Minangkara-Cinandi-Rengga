<?php
    function getConnection(){
        $server = "localhost";
        $username = "root";
        $password = "";
        $dbname = "brixhacktiv8";

        $conn = new mysqli($server, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Koneksi Gagal: ". $conn->connect_error);
        } else {
            return $conn;
        }
    }