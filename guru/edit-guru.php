<?php

session_start();
if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";
$title = "Tambah Guru - MA YPPA CIPULUS";
require_once "../template/header.php";
require_once "../template/navbarr.php";
require_once "../template/sidebar.php";

$id = $_GET['id'];

$queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru WHERE id = $id");
$data = mysqli_fetch_array($queryGuru);
?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update Guru</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="guru.php">Guru</a></li>
                <li class="breadcrumb-item active">Update Guru</li>
            </ol>
            <form action="proses-guru.php" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-pen"></i> Update Guru</span>
                        <button type="submit" name="update" class="btn btn-sm btn-primary float-end"><i
                                class="fa-solid fa-floppy-disk"></i> Update</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                <div class="mb-3 row">
                                    <label for="nip" class="col-sm-2 col-from-label">NIP</label>
                                    <label for="nip" class="col-sm-1 col-from-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" name="nip" pattern="[0-9]{18,}" title="minmal 18 angka"
                                            class="form-control ps-2 border-0 border-bottom" value="<?= $data['nip'] ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-2 col-from-label">Nama</label>
                                    <label for="nama" class="col-sm-1 col-from-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" name="nama" class="form-control ps-2 border-0 border-bottom"
                                            value="<?= $data['nama'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="telpon" class="col-sm-2 col-from-label">Telpon</label>
                                    <label for="telpon" class="col-sm-1 col-from-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="tel" name="telpon" class="form-control ps-2 border-0 border-bottom"
                                            value="<?= $data['telpon'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="agama" class="col-sm-2 col-from-label">Agama</label>
                                    <label for="agama" class="col-sm-1 col-from-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <select name="agama" id="agama" class="form-select border-0 border-bottom"
                                            required>
                                            <?php
                                            $agama = ['Islam', 'Kristen', 'Hindu', 'Budha'];
                                            foreach ($agama as $rlg) {
                                                if ($data['agama'] == $rlg) { ?>
                                                    <option value="<?= $rlg ?>" selected>
                                                        <?= $rlg ?>
                                                    </option>
                                                <?php } else { ?>
                                                    <option value="<?= $rlg ?>">
                                                        <?= $rlg ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 col-from-label">Alamat</label>
                                    <label for="alamat" class="col-sm-1 col-from-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control"
                                            required><?= $data['alamat'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center px-5">
                                <input type="hidden" name="fotoLama" value="<?= $data['foto'] ?>">
                                <img src="../asset/image/<?= $data['foto'] ?>" alt="" class="mb-3 rounded-circle"
                                    width="40%">
                                <input type="file" name="image" class="form-control control-sm">
                                <small class="text-secondary">Pilih foto PNG, JPG, atau jpeg</small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>


    <?php

    require_once "../template/footer.php";

    ?>