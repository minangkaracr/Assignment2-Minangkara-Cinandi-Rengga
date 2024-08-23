<?php
    require_once("connection.php");

    @$perintah = $_GET["perintah"];
    @$id = $_GET['id'];

    function getPostData($i) {
        $data ="";
        if (isset($_POST[$i])){
            $data = @$_POST[$i];
        }

        return $data;
    };

    function getGetData($i) {
        $data = "";
        if (isset($_GET[$i])){
            $data = @$_GET[$i];
        }

        return $data;
    }

    function saveData($conn, $nama, $role, $availability, $age, $lokasi, $pengalaman, $email) {
        $sql = $conn->prepare("INSERT INTO brixhacktiv8.data_portfolio
                                (nama, `role`, availability, age, lokasi, pengalaman, email)
                                VALUES(?,?,?,?,?,?,?)");
        $sql->bind_param("sssisss", $nama, $role, $availability, $age, $lokasi, $pengalaman, $email);
        $result = $sql->execute();

        if ($result === false) {
            echo "Error: ".$sql->error;
            die();
        } else {
            echo "Data karyawan berhasil ditambahkan<br>";
            session_start();
            $_SESSION["message"] = "Data ".$nama." Berhasil ditambahkan";
            header("location: login.php");
        }

        $sql->close();
    }

    function getData($conn, $id){
        $sql = "select * from data_portfolio dp 
                where id = '$id'";
        $result = $conn->query($sql);
        $data = [];

        if ($result) {            
            $data = $result->fetch_assoc();
        }

        return $data;
    }

    function countData($id){
        $data = strlen($id);
        return $data;
    }
    

    // Main Program
    $conn = getConnection();
    $nama = getPostData("nama");
    $role = getPostData("role");
    $availability = getPostData("availability");
    $age = getPostData("age");
    $lokasi = getPostData("lokasi");
    $pengalaman = getPostData("pengalaman");
    $email = getPostData("email");
    $tambah = getPostData("tambah");

    $perintah = getGetData("perintah");
    $id = getGetData("id");
    
    //Menghitung Jumlah
    $countNama = countData($nama);
    $countRole = countData($role);
    $countLokasi = countData($lokasi);
    $countEmail = countData($email);

    // Cek tidak ada yg null
    if (($nama == "" || $role == "" || $availability =="" || $age =="" || $lokasi ==""|| $pengalaman ==""|| $email =="" ) && $tambah){
        session_start();
        $_SESSION["message"] = "Ada data yang tidak diisi mohon dilengkapi";
        header("location: login.php");
    } else {
        if (($countNama > 2) || ($countRole > 2) || ($countLokasi > 2) || ($pengalaman < 100 && $pengalaman >= 0) || ($countEmail > 2) || ($age < 1 && $age<100)){
            session_start();
            $_SESSION["message"] = "Mohon untuk inputan lebih dari 2 character dan/atau umur/pengalaman lebih dari 0 dan kurang dari 100✌🏻";
        } else {
            if($tambah == "create"){
                saveData($conn, $nama, $role, $availability, $age, $lokasi, $pengalaman, $email);
            } else if ($perintah == "read"){
                $data = getData($conn, $id);
            }
        }
    }   



