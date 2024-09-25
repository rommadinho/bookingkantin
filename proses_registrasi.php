<?php
include('koneksi.php');

// Pastikan variabel password ada dalam $_POST dan memiliki nilai
if(isset($_POST['password'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Mengenkripsi password dengan md5

    $query = "INSERT INTO user(nim, nama, username, password) VALUES ('$nim', '$nama', '$username', '$password')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Akun berhasil didaftarkan!');window.location='registrasi_mahasiswa.php';</script>";
    } else{
        echo "Pendaftaran akun gagal : " .mysqli_error($koneksi);
    }
} else {
    echo "Password tidak ditemukan dalam data POST.";
}
?>
