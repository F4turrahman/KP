<?php
include 'DATABASE FILE/koneksi.php';
$id = $_GET["id"];
$op = $_GET["op"];
$tahun = $_GET["tahun"];
//mengambil id yang ingin dihapus

if($op == "hapus_domain"){
  //jalankan query DELETE untuk menghapus data
  $query = "DELETE FROM domain WHERE nomor_domain='$id' ";
  $hasil_query = mysqli_query($koneksi, $query);
  
  //periksa query, apakah ada kesalahan
  if(!$hasil_query) {
    die ("Gagal menghapus data: ".mysqli_errno($koneksi).
     " - ".mysqli_error($koneksi));
  } else {
    echo "<script>alert('Data berhasil dihapus.');window.location='index.php?manajemen_indeks';</script>";
  }
} elseif ($op == "hapus_aspek") {
  //jalankan query DELETE untuk menghapus data
  $query = "DELETE FROM aspek WHERE nomor_aspek='$id' ";
  $hasil_query = mysqli_query($koneksi, $query);
  
  //periksa query, apakah ada kesalahan
  if(!$hasil_query) {
    die ("Gagal menghapus data: ".mysqli_errno($koneksi).
     " - ".mysqli_error($koneksi));
  } else {
    echo "<script>alert('Data berhasil dihapus.');window.location='index.php?manajemen_indeks';</script>";
  }
} elseif ($op == "hapus_indikator") {
  //jalankan query DELETE untuk menghapus data
  $query = "DELETE FROM indikator WHERE nomor_indikator='$id' ";
  $hasil_query = mysqli_query($koneksi, $query);
  
  //periksa query, apakah ada kesalahan
  if(!$hasil_query) {
    die ("Gagal menghapus data: ".mysqli_errno($koneksi).
     " - ".mysqli_error($koneksi));
  } else {
    echo "<script>alert('Data berhasil dihapus.');window.location='index.php?manajemen_indeks';</script>";
  }
} elseif ($op == "hapus_penjelas_indikator") {
  //jalankan query DELETE untuk menghapus data
  $query = "DELETE FROM tabel_penilaian WHERE nomor_indikator = '$id' AND tahun = '$tahun' ";
  $hasil_query = mysqli_query($koneksi, $query);
  
  //periksa query, apakah ada kesalahan
  if(!$hasil_query) {
    die ("Gagal menghapus data: ".mysqli_errno($koneksi).
     " - ".mysqli_error($koneksi));
  } else {
    echo "<script>alert('Data berhasil dihapus.');window.location='index.php?pilih_tahun';</script>";
  }
} else {
  //jalankan query DELETE untuk menghapus data
  $query = "DELETE FROM bukti_pendukung WHERE nama_file ='$id'";
  $hasil_query = mysqli_query($koneksi, $query);
  
  //periksa query, apakah ada kesalahan
  if(!$hasil_query) {
    die ("Gagal menghapus data: ".mysqli_errno($koneksi).
     " - ".mysqli_error($koneksi));
  } else {
    echo "<script>alert('File PDF berhasil dihapus.');window.location='index.php?tugas_penilaian_mandiri';</script>";
  }
}
?>