<?php
// Load file koneksi.php
include('koneksi.php');
// Ambil Data yang Dikirim dari Form
if(isset($_POST['Daftar'])){
  if(empty($_FILES["foto"]["name"])){
    echo ('foto name empty');
  }
  $id = $_POST['id'];
  $nis = $_POST['nis'];
  $nama = $_POST['nama'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $telp = $_POST['telp'];
  $alamat = $_POST['alamat'];
  $foto = $_FILES['foto']['name'];
  $tmp = $_FILES['foto']['tmp_name'];
  echo ('this is foto: '.$foto.'<br>');
  echo ('this is tmp: '.$tmp.'<br>');
  // Rename nama fotonya dengan menambahkan tanggal dan jam upload
  $fotobaru = date('dmYHis').$foto;
  echo ('this is fotobaru: '.$fotobaru.'<br>');
  // Set path folder tempat menyimpan fotonya
  $path = "images/".$fotobaru;
  echo ('this is path: '.$path.'<br>');
  // Proses upload
  if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
    // Proses simpan ke Database
    $sql = $pdo->prepare("INSERT INTO siswa(id, nis, nama, jenis_kelamin, telp, alamat, foto) VALUES(:id, :nis,:nama,:jk,:telp,:alamat,:foto)");
    $sql->bindParam(':id', $id);
    $sql->bindParam(':nis', $nis);
    $sql->bindParam(':nama', $nama);
    $sql->bindParam(':jk', $jenis_kelamin);
    $sql->bindParam(':telp', $telp);
    $sql->bindParam(':alamat', $alamat);
    $sql->bindParam(':foto', $fotobaru);
    $sql->execute(); // Eksekusi query insert
    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
      // Jika Sukses, Lakukan :
      header("location: index.php"); // Redirect ke halaman index.php
    }else{
      // Jika Gagal, Lakukan :
      echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
      echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
    }
  }else{
    // Jika gambar gagal diupload, Lakukan :
    echo "Maaf, Gambar gagal untuk diupload.";
    echo ("<br>");
    echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
  }
}
else{
  echo ('????');
}
?>