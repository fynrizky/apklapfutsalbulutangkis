<?php 
session_start();
include_once "../config/koneksi.php";



if (isset($_POST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $ambil = $koneksi->query("SELECT * FROM users WHERE username = '$username'");
        $yangcocok = $ambil->num_rows;

        if ($yangcocok === 1) {
                $row = $ambil->fetch_assoc();
                // $username = $row["username"];
                // $level = $row['level'];

                $data = [
                    'id_user' => $row['id_user'],
                    'namauser' => $row['nama_user'],
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'level' => $row['level']
                ];


                if ($data['username'] <> '') { //artinya jika usernamenya tidak sama dengan kosong. bisa diganti dengan !== artinya juga sama jika tidak sama dengan/identik.
                    //  session_start();
                    $_SESSION['user'] = $data['username']; // data username diberikan session untuk mengetahui namanya
                    $_SESSION['namausr'] = $data['namauser']; // data username diberikan session untuk mengetahui namanya
                }
                if ($data['level'] == '1') {
                    $_SESSION['admin'] = 'TRUE';
                }
                if ($data['level'] ==   '2') {
                    $_SESSION['pimpinan'] = 'TRUE';
                }


                //$_SESSION['adm'] = $row ; //yang ini salah karna cuma mendapatkan username/ dengan menggunakan username saja tetep bisa masuk ke sistem
                if (password_verify($password, $data["password"])) {
                        $_SESSION['adm'] = $data; //$data pada baris password_verify/($ambil->fetch_assoc()) diberikan session agar password yg benar diizinkan masuk ke sistem

                        echo "<script>alert('Login Sukses');</script>";
                        echo "<div class='alert alert-info'>Login Success</div>";
                        echo "<meta http-equiv='refresh' content='1;url=../?page=dashboard'>";
                    } else {
                        //pasword salah tidak diizinkan masuk
                        echo "<script>alert('Password Salah');</script>";
                        echo "<div class='alert alert-info'>Login Failed</div>";
                        echo "<meta http-equiv='refresh' content='1;url=../?page=dashboard'>";
                    }
            } else {
                //username tidak ada di db
                echo "<script>alert('Password Dan Username Tidak Cocok')</script>";
                echo "<div class='alert alert-info'>Login Failed</div>";
                echo "<meta http-equiv='refresh' content='1;url=../?page=dashboard'>";
            }
    }




if (isset($_GET['logout'])) {


        include_once "logout.php";
    }
 ?>