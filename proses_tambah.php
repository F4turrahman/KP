<?php
include 'DATABASE FILE/koneksi.php';
if (isset($_POST['tambah_domain'])) {
    $nomor_domain = $_POST['nomor_domain'];
    $nama_domain = $_POST['nama_domain'];

    $query = "INSERT INTO domain (nomor_domain, nama_domain) VALUES ('$nomor_domain', '$nama_domain')";
    $hasil = $koneksi->query($query);
    // periska query apakah ada error
    if(!$hasil){
      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Data berhasil ditambah.');window.location='index.php?manajemen_indeks';</script>";
    }
    // Menutup koneksi
    $koneksi->close();
} elseif (isset($_POST['edit_domain'])) {
    $nomor_domain = $_POST['nomor_domain'];
    $nama_domain = $_POST['nama_domain'];

    $query = "UPDATE domain SET nomor_domain = '$nomor_domain', nama_domain = '$nama_domain' WHERE nomor_domain = '$nomor_domain'";
    $hasil = $koneksi->query($query);
    // periska query apakah ada error
    if(!$hasil){
      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Data berhasil ditambah.');window.location='index.php?manajemen_indeks';</script>";
    }
} elseif (isset($_POST['tambah_aspek'])) {
    $nomor_aspek = $_POST['nomor_aspek'];
    $nama_aspek = $_POST['nama_aspek'];
    $nomor_domain = $_POST['nomor_domain'];

    $query = "SELECT * FROM domain WHERE nomor_domain = '$nomor_domain'";
    $hasil = $koneksi->query($query);

    $data = mysqli_fetch_array($hasil);
    $nama_domain = $data['nama_domain'];

    $query = "INSERT INTO aspek (nomor_aspek, nama_aspek, nomor_domain, nama_domain) VALUES ('$nomor_aspek', '$nama_aspek', '$nomor_domain', '$nama_domain')";
    $hasil = $koneksi->query($query);
    // periska query apakah ada error
    if(!$hasil){
      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Data berhasil ditambah.');window.location='index.php?manajemen_indeks';</script>";
    }
} elseif (isset($_POST['edit_aspek'])) {
    $nomor_aspek = $_POST['nomor_aspek'];
    $nama_aspek = $_POST['nama_aspek'];
    $nomor_domain = $_POST['nomor_domain'];

    $query = "SELECT * FROM domain WHERE nomor_domain = '$nomor_domain'";
    $hasil = $koneksi->query($query);

    $data = mysqli_fetch_array($hasil);
    $nama_domain = $data['nama_domain'];

    $query = "UPDATE aspek SET nomor_aspek = '$nomor_aspek', nama_aspek = '$nama_aspek', nomor_domain = '$nomor_domain', nama_domain = '$nama_domain' WHERE nomor_aspek = '$nomor_aspek'";
    $hasil = $koneksi->query($query);
    if(!$hasil){
      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Data berhasil ditambah.');window.location='index.php?manajemen_indeks';</script>";
    }
} elseif (isset($_POST['tambah_indikator'])) {
    // membuat variabel untuk menampung data dari form
    $nomor_indikator = $_POST['nomor_indikator'];
    $nama_indikator = $_POST['nama_indikator'];
    $nomor_aspek = $_POST['nomor_aspek'];

    $query = "SELECT * FROM aspek WHERE nomor_aspek = '$nomor_aspek'";
    $hasil = $koneksi->query($query);

    $data = mysqli_fetch_array($hasil);
    $nama_aspek = $data['nama_aspek'];
    $nomor_domain = $data['nomor_domain'];
    $nama_domain = $data['nama_domain'];

    $query = "INSERT INTO indikator (nomor_indikator, nama_indikator, nomor_aspek, nama_aspek, nomor_domain, nama_domain) VALUES ('$nomor_indikator', '$nama_indikator', '$nomor_aspek', '$nama_aspek', '$nomor_domain', '$nama_domain')";
    $hasil = $koneksi->query($query);
    
    // periska query apakah ada error
    if(!$hasil){
      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Data berhasil ditambah.');window.location='index.php?manajemen_indeks';</script>";
    }
} elseif (isset($_POST['edit_indikator'])) {
    $nomor_indikator = $_POST['nomor_indikator'];
    $nama_indikator = $_POST['nama_indikator'];
    $nomor_aspek = $_POST['nomor_aspek'];

    $query = "SELECT * FROM aspek WHERE nomor_aspek = '$nomor_aspek'";
    $hasil = $koneksi->query($query);

    $data = mysqli_fetch_array($hasil);
    $nama_aspek = $data['nama_aspek'];
    $nomor_domain = $data['nomor_domain'];
    $nama_domain = $data['nama_domain'];

    $query = "UPDATE indikator SET nomor_indikator = '$nomor_indikator', nama_indikator = '$nama_indikator', nomor_aspek = '$nomor_aspek', nama_aspek = '$nama_aspek', nomor_domain = '$nomor_domain', nama_domain = '$nama_domain' WHERE nomor_indikator = '$nomor_indikator'";
    $hasil = $koneksi->query($query);
    if(!$hasil){
      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Data berhasil ditambah.');window.location='index.php?manajemen_indeks';</script>";
    } 
} elseif (isset($_POST['tambah_kriteria_indikator'])) {
    $nomor_indikator = $_POST['nomor_indikator'];
    $kriteria_tingkat_1 = $_POST['kriteria_tingkat_1'];
    $kriteria_tingkat_2 = $_POST['kriteria_tingkat_2'];
    $kriteria_tingkat_3 = $_POST['kriteria_tingkat_3'];
    $kriteria_tingkat_4 = $_POST['kriteria_tingkat_4'];
    $kriteria_tingkat_5 = $_POST['kriteria_tingkat_5'];
    $bobot = $_POST['bobot'];
    $tahun = $_POST['tahun'];

    $query = "SELECT * FROM indikator WHERE nomor_indikator = $nomor_indikator";
    $result = mysqli_query($koneksi, $query);

    $data = mysqli_fetch_array($result);
    $nomor_aspek = $data['nomor_aspek'];
    $nama_indikator = $data['nama_indikator'];

    $query = "SELECT * FROM aspek WHERE nomor_aspek = $nomor_aspek";
    $result = mysqli_query($koneksi, $query);

    $data = mysqli_fetch_array($result);
    $nama_aspek = $data['nama_aspek'];
    $nomor_domain = $data['nomor_domain'];

    $query = "SELECT * FROM domain WHERE nomor_domain = $nomor_domain";
    $result = mysqli_query($koneksi, $query);

    $data = mysqli_fetch_array($result);
    $nama_domain = $data['nama_domain'];

    $query = "INSERT INTO tabel_penilaian (nomor_indikator, nama_indikator, nama_aspek, nama_domain, kriteria_tingkat_1, kriteria_tingkat_2, kriteria_tingkat_3, kriteria_tingkat_4, kriteria_tingkat_5, bobot, tahun) VALUES ('$nomor_indikator','$nama_indikator','$nama_aspek','$nama_domain','$kriteria_tingkat_1', '$kriteria_tingkat_2', '$kriteria_tingkat_3', '$kriteria_tingkat_4', '$kriteria_tingkat_5', '$bobot', '$tahun')";
    $hasil = $koneksi->query($query);

    // periska query apakah ada error
    if(!$hasil){
      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Data berhasil ditambah.');window.location='index.php?manajemen_indeks';</script>";
    }
} elseif (isset($_POST['tambah_penjelasan_indikator'])) {
    // membuat variabel untuk menampung data dari form
    $nomor_indikator = $_POST['nomor_indikator'];
    $penjelasan_tingkat_1 = $_POST['penjelasan_tingkat_1'];
    $penjelasan_tingkat_2 = $_POST['penjelasan_tingkat_2'];
    $penjelasan_tingkat_3 = $_POST['penjelasan_tingkat_3'];
    $penjelasan_tingkat_4 = $_POST['penjelasan_tingkat_4'];
    $penjelasan_tingkat_5 = $_POST['penjelasan_tingkat_5'];
    $total_bobot = $_POST['total_bobot'];
    $tahun = $_POST['tahun'];
    $akhir = 0;

    $sql = "SELECT COUNT(*) AS total FROM tabel_penilaian WHERE (nomor_indikator = '$nomor_indikator' AND tahun = '$tahun') OR penjelasan_tingkat_1 IS NULL OR penjelasan_tingkat_1 = '' OR penjelasan_tingkat_2 IS NULL OR penjelasan_tingkat_2 = '' OR penjelasan_tingkat_3 IS NULL OR penjelasan_tingkat_3 = '' OR penjelasan_tingkat_4 IS NULL OR penjelasan_tingkat_4 = '' OR penjelasan_tingkat_5 IS NULL OR penjelasan_tingkat_5 = '' OR total_bobot IS NULL OR total_bobot = ''";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        // Data ditemukan
        $row = $result->fetch_assoc();
        $total = $row["total"];

        if ($total = 0) {
            $query = "INSERT INTO tabel_penilaian (penjelasan_tingkat_1, penjelasan_tingkat_2, penjelasan_tingkat_3, penjelasan_tingkat_4, penjelasan_tingkat_5, total_bobot) VALUES ('$penjelasan_tingkat_1', '$penjelasan_tingkat_2', '$penjelasan_tingkat_3', '$penjelasan_tingkat_4', '$penjelasan_tingkat_5', '$total_bobot')";
            $hasil = $koneksi->query($query);
            // periska query apakah ada error
            if(!$hasil){
              die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                   " - ".mysqli_error($koneksi));
            } else {
              //tampil alert dan akan redirect ke halaman index.php
              //silahkan ganti index.php sesuai halaman yang akan dituju
              $akhir++;
            }
        } else {
            $query = "UPDATE tabel_penilaian SET penjelasan_tingkat_1 = '$penjelasan_tingkat_1', penjelasan_tingkat_2 = '$penjelasan_tingkat_2', penjelasan_tingkat_3 = '$penjelasan_tingkat_3', penjelasan_tingkat_4 = '$penjelasan_tingkat_4', penjelasan_tingkat_5 = '$penjelasan_tingkat_5', total_bobot = '$total_bobot' WHERE (nomor_indikator = '$nomor_indikator' AND tahun = '$tahun')";
            $hasil = $koneksi->query($query);
            if(!$hasil){
              die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                   " - ".mysqli_error($koneksi));
            } else {
              //tampil alert dan akan redirect ke halaman index.php
              //silahkan ganti index.php sesuai halaman yang akan dituju
              $akhir++;
            }
        }
    } else {
        echo "Tidak ada data yang ditemukan.";
    }
    
    $pdfFileFile = $_FILES['pdfFile']['name'];
    $pdfFileTmpName = $_FILES['pdfFile']['tmp_name'];
    $pdfFileSize = $_FILES['pdfFile']['size'];
    $pdfFileFileType = $_FILES['pdfFile']['type'];
    // Tentukan folder tujuan untuk menyimpan file PDF yang diunggah
    $uploadDir = "bukti_pendukung/";
    // Cek apakah file yang diunggah adalah file PDF
    $allowedTypes = array("application/pdf");
    if (in_array($pdfFileFileType, $allowedTypes)) {
        $uploadPath = $uploadDir . $pdfFileFile;
        if (move_uploaded_file($pdfFileTmpName, $uploadPath)) {
            // Jika file berhasil diunggah, simpan informasi file ke database
            $sql = "INSERT INTO bukti_pendukung (nomor_indikator, nama_file, tahun, ukuran_file, tipe_file, lokasi_file) VALUES ('$nomor_indikator', '$pdfFileFile', '$tahun', '$pdfFileSize', '$pdfFileFileType', '$uploadPath')";
            if ($koneksi->query($sql) === TRUE && $akhir != 0) {
                echo "<script>alert('Data berhasil ditambah (Beserta PDF).');window.location='index.php?tugas_penilaian_mandiri';</script>";
            } else {
                echo "Error: " . $sql . "<br> window.location='index.php?tugas_penilaian_mandiri'" . $koneksi->error ;
            }
        } else {
            echo "<script>alert('Gagal mengunggah file.');window.location='index.php?tugas_penilaian_mandiri';</script>";
        }
    } elseif ($akhir != 0) {
        echo "<script>alert('Data berhasil ditambah.');window.location='index.php?tugas_penilaian_mandiri';</script>";
    } else {
        echo "<script>alert('Jenis file yang diunggah harus berupa PDF.');window.location='index.php?tugas_penilaian_mandiri';</script>";
    }
    // Menutup koneksi
    $koneksi->close();
}
/*

*/
?>