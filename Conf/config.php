<?php
$koneksi = mysqli_connect('127.0.0.1:3306','root','root','db_local_rms');

// mengecek koneksi
if(!$koneksi){
    die("gagal :". mysqli_connect_error());
}
else{
    echo "berhasil";
}
?>