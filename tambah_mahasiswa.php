<?php include('koneksi.php'); ?>
<html>
<head>
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <title>Tambah Mahasiswa</title>
</head>
<div class="heading">
    <div class="header-title">
        <h1>Tambah Mahasiswa</h1>
    </div>
    <div class="header-button">
        <a href="index.php" class="tombol tambah">Kembali</a>
    </div>
</div>
<body>
    <div class="content-form">
    <?php
        if (isset($_POST['submit'])) {
            $nim                        = $_POST['nim'];
            $nama                       = $_POST['nama'];
            $jenis_kelamin                  = $_POST['jenis_kelamin'];
            $agama                      = $_POST['agama'];
            $olahraga                   = implode(", ", $_POST['olahraga']);
            $ekstensi_diperbolehkan     = array('png', 'jpg');
            $file_nama                  = $_FILES['file']['name'];
            $x                          = explode('.', $file_nama);
            $ekstensi                   = strtolower(end($x));
            $ukuran                     = $_FILES['file']['size'];
            $file_tmp                   = $_FILES['file']['tmp_name'];

            $cek = mysqli_query($kon, "SELECT * FROM mahasiswa WHERE nim='$nim'") or die(mysqli_error($koneksi));

            if (mysqli_num_rows($cek) == 0) {
                if (in_array($ekstensi, $ekstensi_diperbolehkan) == true) {
                    if ($ukuran < 1044070) {
                        move_uploaded_file($file_tmp, 'file/' . $file_nama);
                        $sql = mysqli_query($kon, "INSERT INTO mahasiswa(nim, nama, jenis_kelamin, agama, olahraga, nama_file) VALUES('$nim', '$nama', '$jenis_kelamin', '$agama', '".$olahraga."', '$file_nama')") or die(mysqli_error($koneksi));

                        if ($sql) {
                            echo '<script>alert("Berhasil menambahkan data."); document.location="index.php";</script>';
                        } else {
                            echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning">UKURAN FILE TERLALU BESAR</div>';
                    }
                } else {
                    echo '<div class="alert alert-warning">EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN</div>';
                }
            } else {
                echo '<div class="alert alert-warning">Gagal, NIM sudah terdaftar.</div>';
            }
        }
        ?>

        <form action="tambah_mahasiswa.php" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                    <input type="text" name="nim" class="form-control" size="9" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="Laki-laki" required>
                        <label class="form-check-label">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="Perempuan" required>
                        <label class="form-check-label">Perempuan</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-10">
                <select class="form-control" id="agama" name="agama">
                <option value="Islam" selected>Islam</option>
                <option value="Protestan">Protestan</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Olahraga</label>
                <div class="col-sm-10">
                <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Sepak Bola">
                        <label class="form-check-label">
                            Sepak Bola
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]"  value="Basket">
                        <label class="form-check-label">
                            Basket
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]"  value="Futsal">
                        <label class="form-check-label">
                            Futsal
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Renang">
                        <label class="form-check-label">
                            Renang
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]"  value="Badminton">
                        <label class="form-check-label">
                            Badminton
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">File Upload</label>
                <div class="col-sm-10">
                    <input type="file" name="file">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">&nbsp;</label>
                <div class="col-sm-2">
                    <input type="submit" name="submit" class="btn btn-success btn-block" value="Simpan">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
