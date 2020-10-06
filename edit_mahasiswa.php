<?php include('koneksi.php'); 

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $select = mysqli_query($kon, "SELECT * FROM mahasiswa WHERE id='$id'") or die(mysqli_error($koneksi));

        if (mysqli_num_rows($select) == 0) {
            echo '<div class="alert-warning">ID tidak ada dalam database.<div>';
            exit();
        } else{
            $data = mysqli_fetch_assoc($select);
        }
        $dataolah=explode(', ', $data['olahraga']);
    }
?>
<html>
<head>
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <title>Edit Mahasiswa</title>
</head>
<div class="heading">
    <div class="header-title">
        <h1>Edit Mahasiswa</h1>
    </div>
    <div class="header-button">
        <a href="index.php" class="tombol tambah">Kembali</a>
    </div>
</div>
<body>

    <div class="content-form">
        
        <?php
        
        if (isset($_POST['submit'])){
            $nim                        = $_POST['nim'];
            $nama                       = $_POST['nama'];
            $jenis_kelamin              = $_POST['jenis_kelamin'];
            $agama                      = $_POST['agama'];
            $olahraga                   = implode(", ", $_POST['olahraga']);
            $ekstensi_diperbolehkan     = array('png', 'jpg');
            $file_nama                  = $_FILES['file']['name'];
            $x                          = explode('.', $file_nama);
            $ekstensi                   = strtolower(end($x));
            $ukuran                     = $_FILES['file']['size'];
            $file_tmp                   = $_FILES['file']['tmp_name'];

           

            if($file_nama != ""){
                if (in_array($ekstensi, $ekstensi_diperbolehkan) == true) {
                    if ($ukuran < 1044070) {
                        move_uploaded_file($file_tmp, 'file/' . $file_nama);
                        $sql = mysqli_query($kon, "UPDATE mahasiswa SET nama='$nama', jenis_kelamin='$jenis_kelamin', agama='$agama', olahraga='$olahraga', nama_file='$file_nama' WHERE id='$id'") or die(mysqli_error($koneksi));
                        if ($sql) {
                            echo '<script>alert("Berhasil mengubah data."); document.location="index.php";</script>';
                        } else {
                            echo '<div class="alert alert-warning">Gagal melakukan proses ubah data.</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning">UKURAN FILE TERLALU BESAR</div>';
                    }
                } else {
                    echo '<div class="alert alert-warning">EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN</div>';
                }
            }else{
                $sql = mysqli_query($kon, "UPDATE mahasiswa SET nama='$nama', jenis_kelamin='$jenis_kelamin', agama='$agama', olahraga='$olahraga' WHERE id='$id'") or die(mysqli_error($koneksi));
                if ($sql) {
                    echo '<script>alert("Berhasil mengubah data."); document.location="index.php";</script>';
                } else {
                    echo '<div class="alert alert-warning">Gagal melakukan proses ubah data.</div>';
                }
            }
        }
        ?>


        <form action="edit_mahasiswa.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                    <input type="text" name="nim" class="form-control" size="9" value="<?php echo $data['nim']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="Laki-laki"  <?php if ($data['jenis_kelamin'] == 'Laki-laki') {
																												echo 'checked';
																											} ?> required>
                        <label class="form-check-label">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="Perempuan"  <?php if ($data['jenis_kelamin'] == 'Perempuan') {
																												echo 'checked';
																											} ?> required>
                        <label class="form-check-label">Perempuan</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-10">
                <?php $agama = $data["agama"];?>
                <select class="form-control" id="agama" name="agama">
                <option value="Islam" <?php echo ($agama == 'Islam') ? "selected": ""?>>Islam</option>
                <option value="Protestan" <?php echo ($agama == 'Protestan') ? "selected": ""?>>Protestan</option>
                <option value="Katolik" <?php echo ($agama == 'Katolik') ? "selected": ""?>>Katolik</option>
                <option value="Hindu" <?php echo ($agama == 'Hindu') ? "selected": ""?>>Hindu</option>
                <option value="Buddha" <?php echo ($agama == 'Buddha') ? "selected": ""?>>Buddha</option>
                <option value="Konghucu" <?php echo ($agama == 'Konghucu') ? "selected": ""?>>Konghucu</option>
            </select>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Olahraga</label>
                <div class="col-sm-10">
                <?php $olahraga = $data["olahraga"];?>
                <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Sepak Bola"
                        <?php if (in_array("Sepak Bola", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Sepak Bola
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Basket"
                        <?php if (in_array("Basket", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Basket
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Futsal"
                        <?php if (in_array("Futsal", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Futsal
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Renang"
                        <?php if (in_array("Renang", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Renang
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Badminton"
                        <?php if (in_array("Badminton", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Badminton
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                <input type="file" name="file">
			</div>
            </div>

            <div class="form-group row" style="padding:0; margin:0;">
                <label class="col-sm-1 col-form-label">&nbsp;</label>
                <div class="col-sm-2" style="margin-left:81px;">
                    <input type="submit" name="submit" class="btn btn-success btn-block" value="Simpan">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
