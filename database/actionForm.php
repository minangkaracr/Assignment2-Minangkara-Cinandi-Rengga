<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "brixhacktiv8";

    $conn = new mysqli($server, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi Gagal: ". $conn->connect_error);
    } else {
        $nama = @$_POST['nama'];    
        $role = @$_POST['role'];    
        $availability = @$_POST['availability'];    
        $age = @$_POST['age'];    
        $lokasi = @$_POST['lokasi'];    
        $pengalaman = @$_POST['pengalaman'];    
        $email = @$_POST['email'];
        $tambah = @$_POST['tambah'];
        @$perintah = $_GET["perintah"];
        @$id = $_GET['id'];

        if($tambah == "create"){
            $sql = "INSERT INTO brixhacktiv8.data_portfolio
                    (nama, `role`, availability, age, lokasi, pengalaman, email)
                    VALUES('$nama', '$role', '$availability', '$age', '$lokasi', '$pengalaman', '$email')";
            $result = $conn->query($sql);
            if ($result==true){
                echo "Data berhasil di tambahkan";
                session_start();
                $_SESSION["message"] = "Data ".$nama." Berhasil ditambahkan";
                header("location: login.php");
            } else {
                echo "Error: Query Failed ".$conn->error;
            }
        } else if ($perintah == "read"){
            $sql = "select * from data_portfolio dp 
                    where id = '$id'";
            $result = $conn->query($sql);

            if ($result) {            
                while($row = $result->fetch_assoc()) {
                    $nama = $row['nama'];    
                    $role = $row['role'];    
                    $availability = $row['availability'];    
                    $age = $row['age'];    
                    $lokasi = $row['lokasi'];    
                    $pengalaman = $row['pengalaman'];    
                    $email = $row['email'];
                }
            }
        }

    }