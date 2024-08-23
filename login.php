<?php
    session_start();
    if (isset($_SESSION['message'])) {
        echo "<script>alert('" . $_SESSION['message'] . "');</script>";
        // Hapus pesan setelah ditampilkan
        unset($_SESSION['message']);
    }
    session_destroy(); 
    
    include("proses.php");

    if (@$data){
        $nama =$data['nama'];    
        $role =$data["role"];    
        $availability =$data["availability"];    
        $age =$data["age"];    
        $lokasi =$data["lokasi"];    
        $pengalaman =$data["pengalaman"];    
        $email =$data["email"];
    }
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootcamp BRIxHacktiv8</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link 
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" 
        rel="stylesheet">
    <style>
        body {
            font-family: "Montserrat", sans-serif;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-disabled="true">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-disabled="true">Inventory</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-6 col-sm-6 mx-auto d-block col-md-2">
                <img src="images/avatar-1.jpg" alt="avatar" class="w-100">
            </div>
            <div class="col col-sm-8 col-md-4 d-flex align-items-center mb-3">
                <div class="row">
                    <h2><b id="myName"><?php if(@$nama && @$data){echo $nama;} else {echo "Name";}?></b></h2>
                    <p id="myRole"><?php if(@$role && @$data){echo $role;} else {echo "Role";}?></p>
                    <div>
                        <button type="button" class="btn btn-primary">Kontak</button>
                        <button type="button" class="btn btn-outline-primary">Resume</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3 align-content-center">
                <?php
                    $infoLabel = ["Availability", "Age", "Lokasi", "Experience", "Email"];
                    if (@$data){
                    $infoFields = [@$availability, @$age, @$lokasi, @$pengalaman, @$email];
                    };
                ?>
                <div>
                        <?php 
                            for ($i = 0; $i < count($infoLabel); $i++) {
                        ?>
                        <div class="row" id="my<?php echo $infoLabel[$i]?>">
                            <div class="col-sm-4"><b><?php echo $infoLabel[$i]?></b></div>
                            <div class="col-sm-8"><?php if (@$data) {if(!$infoFields[$i]){echo "-";} else {echo $infoFields[$i];}}?></div>
                        </div>
                        <?php
                                };
                        ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="padding-bottom: 20px; margin-top: 10px">
        <form action="" method="POST">
            <div class="form-group mb-3">
                <label for="nama" id="name"><b>Nama</b></label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
            </div>
            <div class="form-group mb-3">
                <label for="role" ><b>Role</b></label>
                <input type="text" class="form-control" id="role" name="role" placeholder="Masukkan Role">
            </div>
            <div class="form-group mb-3">
                <label for="availability" ><b>Availability</b></label>
                <select id="availability" name="availability" class="form-select">
                    <option selected="true" disabled="disabled">Pilih Availability</option>
                    <option value="fulltime">Full Time</option>
                    <option value="parttime">Part Time</option>
                    <option value="internship">Internship</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="age" ><b>Umur</b></label>
                <input type="text" class="form-control" id="age" name="age" placeholder="Masukkan Umur">
            </div>
            <div class="form-group mb-3">
                <label for="lokasi" ><b>lokasi</b></label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukkan Lokasi">
                
            </div>
            <div class="form-group mb-3">
                <label for="pengalaman" ><b>Pengalaman</b></label>
                <input type="text" class="form-control" id="pengalaman" name="pengalaman" placeholder="Masukkan Tahun Pengalaman">
                
            </div>
            <div class="form-group mb-3">
                <label for="email" ><b>Email</b></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email">
                <small id="email-error" style="color: red; display: none;">Email tidak valid, mohon masukkan email yang benar</small>                
            </div>
            <div>
                <!-- <button type="submit" class="btn btn-success col-12" id="submitBtn" disabled name="submit_session" value="session">Submit Session</button> -->
                <!-- <button type="submit" class="btn btn-primary col-12" id="submitBtn2" disabled name="submit_cookie" value="cookie">Submit Cookie</button> -->
                <button type="submit" class="btn btn-primary col-12" id="submitBtn3" name="tambah" value="create">Tambahkan</button>
            </div>
        </form>
    </div>
</body>
<footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script> 

    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const emailInput = document.getElementById('email');
        const errorMessage = document.getElementById('email-error');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const submitBtn = document.getElementById('submitBtn');
        const submitBtn2 = document.getElementById('submitBtn2');
        const submitBtn3 = document.getElementById('submitBtn3');
        const ageInput = document.getElementById('age');
        const expInput = document.getElementById('pengalaman');

        emailInput.addEventListener('input', function() {
            const email = emailInput.value;
            if (!emailRegex.test(email)) {
                errorMessage.style.display = 'block';
                submitBtn.disabled = true;
                submitBtn2.disabled = true;
                submitBtn3.disabled = true;
            } else {
                errorMessage.style.display = 'none';
                submitBtn.disabled = false;
                submitBtn2.disabled = false;
                submitBtn3.disabled = false;
            }
        });

        ageInput.addEventListener('keypress', function(event) {
            if (!/^\d$/.test(event.key)) {
                event.preventDefault();
            }
        });

        expInput.addEventListener('keypress', function(event) {
            if (!/^\d$/.test(event.key)) {
                event.preventDefault();
            }
        });

        // $('#submitBtn').on('click', function() {
        //     const nama = $('#nama').val();
        //     const role = $('#role').val();
        //     const availability = $('#availability').val();
        //     const age = $('#age').val() + " Tahun";
        //     const lokasi = $('#lokasi').val();
        //     const pengalaman = $('#pengalaman').val();
        //     const email = $('#email').val();

        //     if (nama == "" || role == "" || availability == "" || age == "" || lokasi == "" || pengalaman == "" || email == ""){
        //         Swal.fire({
        //             icon: "error",
        //             title: "Oops...",
        //             text: "Mohon isi semua formnya",
        //             //footer: '<a href="#">Why do I have this issue?</a>'
        //           });
        //         return true;
        //     } else {
        //         Swal.fire({
        //             title: "Good job!",
        //             text: "Data telah diganti!",
        //             icon: "success"
        //           });
        //     }

        //     $("#myName").html(nama)
        //     $("#myRole").html(role)
        //     $("#myAvailability").html(availability)
        //     $("#myAge").html(age)
        //     $("#myLocation").html(lokasi)
        //     $("#myExperience").html(pengalaman)
        //     $("#myEmail").html(email)
        // });

        // Bisa pake JQuery juga
        // $(document).ready(function(){konten, variabel, $("#id").html(value)})
    </script>
</footer>
</html>