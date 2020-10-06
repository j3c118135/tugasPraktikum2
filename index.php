<html>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <title>Data Mahasiswa</title>
</head>
<div class="heading">
    <div class="header-title">
        <h1>Data Mahasiswa</h1>
    </div>
    <div class="header-button">
        <a href="tambah_mahasiswa.php" class="tombol tambah">Tambah Data</a>
    </div>
</div>
<body>
    <div class="content">
            <table>
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Olahraga</th>
                        <th>Foto</th>
                        <th colspan="2">Aksi</>
                    </tr>
                    <?php
                    include "koneksi.php";
                    $r=mysqli_query($kon,"SELECT * FROM mahasiswa");
                    $i=1;
                    while($brs=mysqli_fetch_assoc($r)) {
                        echo '<form action="03_aksi.php">';
                        echo '<tr>
                                <td>'.$i++.'</td>
                                <td>'.$brs["nama"].'</td>
                                <td>'.$brs["nim"].'</td>
                                <td>'.$brs["jenis_kelamin"].'</td>
                                <td>'.$brs["agama"].'</td>
                                <td>'.$brs["olahraga"].'</td>
                                <td><img src="file/'.$brs["nama_file"].'" width="70px"></td>
                                <td>
                                <a class="tombol edit" href="edit_mahasiswa.php?id='.$brs["id"].'"><i class="icon_pencil"></i></a>
                                <a class="tombol hapus" href="hapus_mahasiswa.php?id='.$brs["id"].'"><i class="icon_trash_alt"></i></a>
                                </td>
                            </tr>';
                    }
                ?>
                </tbody>
            </table>
    </div>
</body>
</html>
