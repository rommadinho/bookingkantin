<?php
    include('koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            height: 100%;
            width: 190px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #323631;
            padding-top: 20px;
        }

        .sidebar h2 {
            color: #fff;
            text-align: center;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px;
            text-align: center;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block; /* Menjadikan tautan sebagai blok */
            padding: 10px; /* Menambahkan jarak di sekitar tautan */
        }

        .sidebar ul li a:hover {
            background-color: #45a049;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .menu {
            background-color: #45a049;
        }

        h1 {
            text-transform: uppercase;
            color: #45a049;
        }

        table {
            border: 1px solid #ddeeee;
            border-collapse: collapse;
            border-spacing: 0;
            width: 70%;
            margin: 10px auto 10px auto;
        }

        table thead th {
            background-color: #7cb570;
            border: 1px solid #ddeeee;
            color: #336b6b;
            padding: 10px;
            text-align: left;
        }

        table tbody td {
            border: 1px solid #ddeeee;
            color: #333;
            padding: 10px;
        }

        .tomboltambah {
            display: inline-block;
            background-color: #26ab2c;
            color: #fff;
            padding: 10px;
            font-size: 12px;
            text-decoration: none;
            margin-right: 10px;
        }
        .tomboledit {
            display: inline-block;
            background-color: #218abf;
            color: #fff;
            padding: 10px;
            font-size: 12px;
            text-decoration: none;
            margin-right: 10px;
        }
        .tombolhapus {
            display: inline-block;
            background-color: #cc0e0e;
            color: #fff;
            padding: 10px;
            font-size: 12px;
            text-decoration: none;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Kantinku</h2>
        <ul>
            <li class="menu"><a href="#">Menu</a></li>
            <li><a href="pesanan_admin.php">Pesanan</a></li>
            <li><a href="login.php" onclick="return confirm('Apakah kamu yakin ingin keluar?');">Log Out</a></li>
        </ul>
    </div>
    <div class="content">
        <center><h1>Data Menu</h1></center>
        <div>
            <center><a class="tomboltambah" href="tambah_menu.php">+ &nbsp; Tambah Menu</a></center>
            <h3>Makanan</h3>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th>Deskripsi</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query_makanan = "SELECT * FROM menu WHERE kategori_id = 1 ORDER BY id ASC";
                        $result_makanan = mysqli_query($koneksi, $query_makanan);
                        
                        if (!$result_makanan) {
                            die("Query Error : ".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
                        }
                        $no = 1;

                        while ($row_makanan = mysqli_fetch_assoc($result_makanan)){
                    ?>
                    <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $row_makanan['kategori_id'];?></td>
                        <td><?php echo $row_makanan['nama'];?></td>
                        <td>Rp <?php echo number_format($row_makanan['harga'], 0, ',', '.');?></td>
                        <td><img src="gambar/<?php echo $row_makanan['foto'];?>" width="100px"></td>
                        <td><?php echo $row_makanan['deskripsi'];?></td>
                        <td><?php echo $row_makanan['ketersediaan_stok'];?></td>
                        <td>
                            <a class="tomboledit" href="edit_menu.php?id=<?php echo $row_makanan['id']?>">Ubah</a>
                            <a class="tombolhapus" href="hapus_menu.php?id=<?php echo $row_makanan['id']?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php
                        $no++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <h3>Minuman</h3>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th>Deskripsi</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query_minuman = "SELECT * FROM menu WHERE kategori_id = 2 ORDER BY id ASC";
                        $result_minuman = mysqli_query($koneksi, $query_minuman);
                        
                        if (!$result_minuman) {
                            die("Query Error : ".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
                        }
                        $no = 1;

                        while ($row_minuman = mysqli_fetch_assoc($result_minuman)){
                    ?>
                    <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $row_minuman['kategori_id'];?></td>
                        <td><?php echo $row_minuman['nama'];?></td>
                        <td>Rp <?php echo number_format($row_minuman['harga'], 0, ',', '.');?></td>
                        <td><img src="gambar/<?php echo $row_minuman['foto'];?>" width="100px"></td>
                        <td><?php echo $row_minuman['deskripsi'];?></td>
                        <td><?php echo $row_minuman['ketersediaan_stok'];?></td>
                        <td>
                            <a class="tomboledit" href="edit_menu.php?id=<?php echo $row_minuman['id']?>">Ubah</a>
                            <a class="tombolhapus" href="hapus_menu.php?id=<?php echo $row_minuman['id']?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php
                        $no++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
