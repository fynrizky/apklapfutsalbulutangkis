<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "sewafutbul";

    $koneksi = new mysqli($host,$user,$pass,$db);

    if($koneksi->connect_errno){
        echo "<script>alert('Gagal Koneksi');</script>". $koneksi->connect_error;
    }


?>