<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
}

require_once "../config.php";

// jika tombol simpan di tekan
if (isset($_POST['simpan'])) {
    // ambil elemen yang di posting
    $username = trim(htmlspecialchars($_POST['username']));
    $nama = trim(htmlspecialchars($_POST['nama']));
    $jabatan = $_POST['jabatan'];
    $alamat = trim(htmlspecialchars($_POST['alamat']));
    $gambar = trim(htmlspecialchars($_FILES['image']['name']));
    $password = 1234;
    $pass = password_hash($password, PASSWORD_DEFAULT);

    // cek user name
    $cekUsername = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE ussername = '$username'");

    if (mysqli_num_rows($cekUsername) > 0) {
        header("location:add-user.php?msg=cancel");
        return;
    }


    // upload
    if ($gambar != null) {
        $url = 'add-user.php';
        $gambar = uploadimg($url);
    } else {
        $gambar = 'default.jpeg';
    }

    mysqli_query($koneksi, "INSERT INTO tbl_user VALUES(null, '$username', '$pass', '$nama', '$alamat', '$jabatan', '$gambar')");

    header("location:add-user.php?msg=added");
    return;

}



?>