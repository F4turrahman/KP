<?php
include_once "db.php";
session_start();
if (isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $userQuery = "SELECT * FROM user WHERE id = '$user_id'";
    $result = mysqli_query($connection, $userQuery);
    $user = mysqli_fetch_assoc($result);
}else{
    header('Location:login.php');
}
include_once "header.php";
include_once "sidebar.php";


if (isset($_POST['dashboard'])){
    include_once "dashboard.php";
}
elseif (isset($_GET['manajemen_indeks'])){
    include_once "manajemen_indeks.php";
}
elseif (isset($_GET['tugas_penilaian_mandiri'])){
    include_once "tugas_penilaian_mandiri.php";
}
elseif (isset($_GET['proses_tambah'])){
    include_once "proses_tambah.php";
}
elseif (isset($_GET['proses_hapus'])){
    include_once "proses_hapus.php";
}
elseif (isset($_GET['proses_edit'])){
    include_once "proses_edit.php";
}
elseif (isset($_GET['cetak'])){
    include_once "cetak.php";
}
else{
    include_once "dashboard.php";
}

include_once "footer.php";