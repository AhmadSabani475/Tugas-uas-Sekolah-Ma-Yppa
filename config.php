<?php

$koneksi = mysqli_connect("localhost", "root", "", "db_sekolah") or die(mysqli_connect_error());

// if (mysqli_connect_errno()){
//     echo "Gagal Konek";
// } else{
//     echo "berhasil konek";
// }

// url induk
$main_url = "http://localhost/sekolah/";


function uploadimg($url)
{
    $namafile = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmp = $_FILES['image']['tmp_name'];


    // cek file yang diupload
    $validExtension = ['jpg', 'jpeg', 'png'];
    $fileExtension = explode('.', $namafile);
    $fileExtension = strtolower(end($fileExtension));
    if (!in_array($fileExtension, $validExtension)) {
        header("location:" . $url . '?msg=notimage');
        die;
    }


    //ukuran gambar
    if ($ukuran > 10000000) {
        header("location:" . $url . '?msg=oversize');
        die;
    }

    // generate nama file gambar
    if ($url == 'profile-sekolah.php') {
        $namafilebaru = rand(0, 50) . '-bgLogin.' . $fileExtension;
    } else {
        $namafilebaru = rand(10, 1000) . '-' . $namafile;
    }

    // upload gambar
    move_uploaded_file($tmp, "../asset/image/" . $namafilebaru);
    return $namafilebaru;
}

?>