<style>
  .form-group {
    display: inline-block;
    width: 200px;
    margin-bottom: 10px;
  }
</style>
<?php
include 'DATABASE FILE/koneksi.php';
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <link rel="stylesheet" href="css/gaya.css" />
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-bed"></em>
                </a></li>
            <li class="active">Tugas Penilaian Mandiri</li>
        </ol>
    </div><!--/.row-->
    <br>
    <form action="index.php?tugas_penilaian_mandiri" method="post">
        <select class="form-group form-control col-lg-6" name="tahun" id="tahun">
            <option value="">- Pilih Tahun -</option>
            <?php
            // Mendapatkan data tahun dari tabel_penilaian dan menyimpannya dalam array
            $query = "SELECT DISTINCT tahun FROM tabel_penilaian ORDER BY tahun ASC";
            $result = mysqli_query($koneksi, $query);
            
            $tahunArray = array(2021); // Array untuk menyimpan tahun yang sudah ditampilkan
            while ($data = mysqli_fetch_array($result)) {
                $tahun = $data['tahun'];
            
                // Jika tahun belum ada dalam array, maka tambahkan ke dalam array dan tampilkan di dropdown
                if (!in_array($tahun, $tahunArray)) {
                    $tahunArray[] = $tahun;
            ?>
                    <option value="<?php echo $tahun ?>"><?php echo $tahun ?></option>
            <?php
                }
            }
            ?>
        </select>
        <input class="btn btn-primary form-group form-control col-lg-6" type="submit" value="Tampilkan">
    </form>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div id="success"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
<?php
if (isset($_POST['tahun'])) { 
    $tahun = $_POST['tahun'];

    // Cari posisi $tahun dalam array $tahunArray
    $posisi = array_search($tahun, $tahunArray);
    
    if ($posisi !== false) {
        if ($posisi > 0) {
            // Jika $tahun bukan merupakan elemen pertama dalam array
            $posisiSebelumnya = $posisi - 1;
            $tahunsebelumnya = $tahunArray[$posisiSebelumnya];
        }
    }
?>
                <div class="panel-heading">
                    Penilaian Indikator Tahun : <?php echo $tahun ?>
                    <a href="cetak.php?tahun=<?php echo $tahun ?>" target="_blank">
                        <button type="button" class="btn btn-secondary pull-right">
                            Cetak Laporan
                        </button>
                    </a>
                </div>
                <div class="panel-body">
                    <center>Nilai Indeks<center>
                    <center>Total<center>
                    <center>
                    <?php
                    $jumlah = "SELECT SUM(bobot) AS jumlah_bobot FROM tabel_penilaian WHERE tahun = '$tahun'";
                    // Eksekusi kueri
                    $hasil = $koneksi->query($jumlah);
                    $row = mysqli_fetch_assoc($hasil);
                    $jumlah_bobot = $row['jumlah_bobot'];
                    $jumlah = "SELECT SUM(total_bobot) AS total_bobot FROM tabel_penilaian WHERE tahun = '$tahun'";
                    // Eksekusi kueri
                    $hasil = $koneksi->query($jumlah);
                    $row = mysqli_fetch_assoc($hasil);
                    $total_bobot = $row['total_bobot'];
                    if ($total_bobot != 0 && $jumlah_bobot != 0) {
                        $nilai = ($total_bobot / $jumlah_bobot) * 5;
                        $nilai_hasil = number_format($nilai, 2);

                        // Cek apakah tabel 'nilai_indeks' kosong
                        $query = "SELECT COUNT(*) as total_data FROM nilai_indeks";
                        $result = mysqli_query($koneksi, $query);
                        $row = mysqli_fetch_assoc($result);

                        if ($row['total_data'] == 0) {
                            // Jika tabel kosong, tambahkan data baru
                            $query_insert = "INSERT INTO nilai_indeks (tahun, total_nilai) VALUES ('$tahun', '$nilai_hasil')"; 
                            mysqli_query($koneksi, $query_insert);
                        } else {
                            // Jika tabel tidak kosong, cek apakah data dengan tahun yang sama sudah ada
                            $query_check = "SELECT * FROM nilai_indeks WHERE tahun = '$tahun'";
                            $result_check = mysqli_query($koneksi, $query_check);

                            if (mysqli_num_rows($result_check) > 0) {
                                // Jika data dengan tahun yang sama sudah ada, update data tersebut
                                $query_update = "UPDATE nilai_indeks SET total_nilai = '$nilai_hasil' WHERE tahun = '$tahun'"; // Ganti nilai 200 sesuai kebutuhan Anda
                                mysqli_query($koneksi, $query_update);
                            } else {
                                // Jika data dengan tahun yang sama belum ada, tambahkan data baru
                                $query_insert_new = "INSERT INTO nilai_indeks (tahun, total_nilai) VALUES ('$tahun', '$nilai_hasil')"; // Ganti nilai 300 sesuai kebutuhan Anda
                                mysqli_query($koneksi, $query_insert_new);
                            }
                        }
                    ?>
                    <h1><?php echo $nilai_hasil; ?></h1>
                    <?php    
                    } else {
                    ?>
                    <h1>0.00</h1>
                    <?php 
                    }
                    ?>
                    <center>
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th colspan="2" class="kiri">Nama Indikator</th>
                                <th>Total Nilai</th>
                                <th style="min-width: 151px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT nomor_indikator FROM tabel_penilaian WHERE tahun = '$tahun'";
                                $result = mysqli_query($koneksi, $query);

                                $data_nomor = array();
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $data_nomor[] = $row['nomor_indikator'];
                                    }
                                }
                                foreach ($data_nomor as $nomor) : 
                                $query = "SELECT * FROM tabel_penilaian WHERE nomor_indikator = '$nomor' AND tahun = '$tahun'";
                                $result = mysqli_query($koneksi, $query);
                                $data = mysqli_fetch_array($result);
                                $nomor_indikator = $data['nomor_indikator'];
                                $nama_indikator = $data['nama_indikator'];
                                $total_bobot = $data['total_bobot'];
                            ?>
                            <tr>
                                <td><?php echo $nomor_indikator ?></td>
                                <td colspan="2" class="kiri"><?php echo $nama_indikator ?></td>
                                <td>
                                    <?php
                                    $nilai = $total_bobot;
                                    $nilai_hasil = number_format($nilai, 2);
                                    echo $nilai_hasil;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $query = "SELECT * FROM tabel_penilaian WHERE nomor_indikator = '$nomor' AND tahun = '$tahun'";
                                    $result = mysqli_query($koneksi, $query);
                                
                                    $data = mysqli_fetch_array($result);
                                    $penjelasan_tingkat_1 = $data['penjelasan_tingkat_1'];
                                    $penjelasan_tingkat_2 = $data['penjelasan_tingkat_2'];
                                    $penjelasan_tingkat_3 = $data['penjelasan_tingkat_3'];
                                    $penjelasan_tingkat_4 = $data['penjelasan_tingkat_4'];
                                    $penjelasan_tingkat_5 = $data['penjelasan_tingkat_5'];
                                    $total_bobot = $data['total_bobot'];

                                    if ($penjelasan_tingkat_1 != NULL && $penjelasan_tingkat_1 != '' || $penjelasan_tingkat_2 != NULL && $penjelasan_tingkat_2 != '' || $penjelasan_tingkat_3 != NULL && $penjelasan_tingkat_3 != '' || $penjelasan_tingkat_4 != NULL && $penjelasan_tingkat_4 != '' || $penjelasan_tingkat_5 != NULL && $penjelasan_tingkat_5 != '' || $total_bobot != NULL && $total_bobot != 0) {
                                        ?>
                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#edit_<?php echo $nomor; ?>">
                                                Edit 
                                            </button>
                                        <?php
                                    } else {
                                        ?>
                                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#edit_<?php echo $nomor; ?>">
                                                Kerjakan 
                                            </button>
                                        <?php
                                    }
                                    ?>
                                    <!---
                                    <a href="index.php?proses_hapus&id=<?php // echo $nomor_indikator ?>&tahun=<?php // echo $tahun ?>&op=hapus_penjelas_indikator">
                                        <button class="btn btn-danger">Hapus</button>
                                    </a>
                                    -->
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit -->
    <?php
    $query = "SELECT nomor_indikator FROM tabel_penilaian WHERE tahun = '$tahun'";
    
    $result = mysqli_query($koneksi, $query);

    $data_nomor = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data_nomor[] = $row['nomor_indikator'];
        }
    }

    // Fungsi untuk mencari data berdasarkan data tahun sebelumnya
    function cariDataDariDatabase($koneksi, $nomor_indikator_yang_dicari, $tahun) {
        $query = "SELECT * FROM tabel_penilaian WHERE nomor_indikator = '$nomor_indikator_yang_dicari' AND tahun = '$tahun'";
        $hasil = $koneksi->query($query);
    
        if ($hasil->num_rows > 0) {
            return $hasil->fetch_assoc();
        } else {
            return null;
        }
    }           
    
    foreach ($data_nomor as $nomor) :
    // Cari data berdasarkan kriteria di database
    $dataDitemukan = cariDataDariDatabase($koneksi, $nomor, $tahunsebelumnya);

    // data tahun sekarang
    $dataSekarang = cariDataDariDatabase($koneksi, $nomor, $tahun);

    $query = "SELECT * FROM tabel_penilaian WHERE nomor_indikator = '$nomor' AND tahun = '$tahun'";
    $result = mysqli_query($koneksi, $query);

    $data = mysqli_fetch_array($result);
    $nomor_indikator = $data['nomor_indikator'];
    $nama_indikator = $data['nama_indikator'];
    $nama_aspek = $data['nama_aspek'];
    $nama_domain = $data['nama_domain'];
    $kriteria_tingkat_1 = $data['kriteria_tingkat_1'];
    $kriteria_tingkat_2 = $data['kriteria_tingkat_2'];
    $kriteria_tingkat_3 = $data['kriteria_tingkat_3'];
    $kriteria_tingkat_4 = $data['kriteria_tingkat_4'];
    $kriteria_tingkat_5 = $data['kriteria_tingkat_5'];
    $penjelasan_tingkat_1 = $data['penjelasan_tingkat_1'];
    $penjelasan_tingkat_2 = $data['penjelasan_tingkat_2'];
    $penjelasan_tingkat_3 = $data['penjelasan_tingkat_3'];
    $penjelasan_tingkat_4 = $data['penjelasan_tingkat_4'];
    $penjelasan_tingkat_5 = $data['penjelasan_tingkat_5'];
    $bobot = $data['bobot'];
    ?>
    <div id="edit_<?php echo $nomor; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Data Indikator <?php echo $nomor_indikator ?> </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="index.php?proses_tambah" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="nomor_indikator" value="<?php echo $nomor_indikator ?>">
                                <input type="hidden" name="tahun" value="<?php echo $tahun ?>">
                                <table class="lebar-tabel">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                           <td class="kiri">Domain</td>
                                           <td>:</td>
                                           <td class="kiri"><?php echo $nama_domain ?></td>
                                       </tr>
                                       <tr>
                                           <td class="kiri">Aspek</td>
                                           <td>:</td>
                                           <td class="kiri"><?php echo $nama_aspek ?></td>
                                       </tr>
                                       <tr>
                                           <td class="kiri">Indikator</td>
                                           <td>:</td>
                                           <td class="kiri"><?php echo $nama_indikator ?></td>
                                       </tr>
                                   </tbody>
                               </table>
                               <table class="lebar-tabel">
                                   <thead>
                                       <tr>
                                           <th>Tingkat</th>
                                           <th class="kiri">Kriteria</th>
                                           <th class="kiri">Capaian Tahun 2022</th>
                                           <th>Capaian</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <tr>
                                           <td rowspan="2">1</td>
                                           <td class="kiri"><?php echo $kriteria_tingkat_1 ?></td>
                                           <td rowspan="2">
                                               <input type="radio" name="nilai_tahun_lalu" value="
                                               <?php
                                               if ($dataDitemukan["bobot"] * 0.2 == $dataDitemukan["total_bobot"]) {
                                                ?>
                                                " checked disabled>
                                                <?php
                                                } else {
                                                ?>
                                                " disabled>
                                                <?php
                                                }
                                               ?>
                                           </td>
                                           <td rowspan="2">
                                               <input type="radio" name="total_bobot" value="
                                               <?php
                                               if ($dataSekarang["bobot"] * 0.2 == $dataSekarang["total_bobot"]) {
                                                    echo $bobot * 0.2; ?>" checked>
                                                <?php
                                                } else { 
                                                    echo $bobot * 0.2; ?>">
                                                <?php
                                                }
                                               ?>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td class="kiri">
                                               <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Penjelasan" value="<?php echo $penjelasan_tingkat_1 ?>" name="penjelasan_tingkat_1">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td rowspan="2">2</td>
                                           <td class="kiri"><?php echo $kriteria_tingkat_2 ?></td>
                                           <td rowspan="2">
                                               <input type="radio" name="nilai_tahun_lalu" value="
                                               <?php
                                               if ($dataDitemukan["bobot"] * 0.4 == $dataDitemukan["total_bobot"]) {
                                                ?>
                                                " checked disabled>
                                                <?php
                                                } else {
                                                ?>
                                                " disabled>
                                                <?php
                                                }
                                               ?>
                                           </td>
                                           <td rowspan="2">
                                               <input type="radio" name="total_bobot" value="
                                               <?php
                                               if ($dataSekarang["bobot"] * 0.4 == $dataSekarang["total_bobot"]) {
                                                    echo $bobot * 0.4; ?>" checked>
                                                <?php
                                                } else {
                                                    echo $bobot * 0.4; ?>">
                                                <?php
                                                }
                                               ?>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td class="kiri">
                                               <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Penjelasan" value="<?php echo $penjelasan_tingkat_2 ?>" name="penjelasan_tingkat_2">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td rowspan="2">3</td>
                                           <td class="kiri"><?php echo $kriteria_tingkat_3 ?></td>
                                           <td rowspan="2">
                                               <input type="radio" name="nilai_tahun_lalu" value="
                                               <?php
                                               if ($dataDitemukan["bobot"] * 0.6 == $dataDitemukan["total_bobot"]) {
                                                ?>
                                                " checked disabled>
                                                <?php
                                                } else {
                                                ?>
                                                " disabled>
                                                <?php
                                                }
                                               ?>
                                           </td>
                                           <td rowspan="2">
                                               <input type="radio" name="total_bobot" value="
                                               <?php
                                               if ($dataSekarang["bobot"] * 0.6 == $dataSekarang["total_bobot"]) {
                                                    echo $bobot * 0.6; ?>" checked>
                                                <?php
                                                } else {
                                                    echo $bobot * 0.6; ?>">
                                                <?php
                                                }
                                               ?>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td class="kiri">
                                               <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Penjelasan" value="<?php echo $penjelasan_tingkat_3 ?>" name="penjelasan_tingkat_3">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td rowspan="2">4</td>
                                           <td class="kiri"><?php echo $kriteria_tingkat_4 ?></td>
                                           <td rowspan="2">
                                               <input type="radio" name="nilai_tahun_lalu" value="
                                               <?php
                                               if ($dataDitemukan["bobot"] * 0.8 == $dataDitemukan["total_bobot"]) {
                                                ?>
                                                " checked disabled>
                                                <?php
                                                } else {
                                                ?>
                                                " disabled>
                                                <?php
                                                }
                                               ?>
                                           </td>
                                           <td rowspan="2">
                                               <input type="radio" name="total_bobot" value="
                                               <?php
                                               if ($dataSekarang["bobot"] * 0.8 == $dataSekarang["total_bobot"]) {
                                                    echo $bobot * 0.8; ?>" checked>
                                                <?php
                                                } else {
                                                    echo $bobot * 0.8; ?>">
                                                <?php
                                                }
                                               ?>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td class="kiri">
                                               <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Penjelasan" value="<?php echo $penjelasan_tingkat_4 ?>" name="penjelasan_tingkat_4">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td rowspan="2">5</td>
                                           <td class="kiri"><?php echo $kriteria_tingkat_5 ?></td>
                                           <td rowspan="2">
                                               <input type="radio" name="nilai_tahun_lalu" value="
                                               <?php
                                               if ($dataDitemukan["bobot"] * 1 == $dataDitemukan["total_bobot"]) {
                                                ?>
                                                " checked disabled>
                                                <?php
                                                } else {
                                                ?>
                                                " disabled>
                                                <?php
                                                }
                                               ?>
                                           </td>
                                           <td rowspan="2">
                                               <input type="radio" name="total_bobot" value="
                                               <?php
                                               if ($dataSekarang["bobot"] * 1 == $dataSekarang["total_bobot"]) {
                                                    echo $bobot * 1; ?>" checked>
                                                <?php
                                                } else {
                                                    echo $bobot * 1; ?>">
                                                <?php
                                                }
                                               ?>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td class="kiri">
                                               <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Penjelasan" value="<?php echo $penjelasan_tingkat_5 ?>" name="penjelasan_tingkat_5">
                                           </td>
                                       </tr>
                                   </tbody>
                               </table>
                               <br>
                               <label for="pdfFile">Upload Bukti Pendukung</label>
                               <input type="file" name="pdfFile" id="pdfFile">
                               <br>
                               <label>Daftar Dokumen Bukti Pendukung</label>
                               <?php
                               $sql = "SELECT nama_file, ukuran_file, tipe_file, lokasi_file FROM bukti_pendukung WHERE nomor_indikator = '$nomor_indikator' AND tahun = '$tahun'";
                               $result = $koneksi->query($sql);    
                               if ($result->num_rows > 0) {
                                   while ($row = $result->fetch_assoc()) {
                                   $namaFile = $row["nama_file"];
                                   $lokasiFile = $row["lokasi_file"];
                               ?>
                               <p> 
                                    <a href="index.php?proses_hapus&id=<?php echo $namaFile ?>&op=hapus_pdf" class="btn btn-danger">
                                        Hapus
                                    </a>
                                    <a href="<?php echo $lokasiFile ?>" class="btn btn-info">
                                        <?php echo $namaFile ?>                                    
                                    </a>
                                </p>
                               <?php
                                   }
                               } else {
                               ?>
                               <p>Tidak ada file PDF yang tersedia.</p>
                               <?php
                               }
                               ?>
                               <br>
                               <a class="btn btn-secondary pull-left" data-toggle="modal" href="index.php?tugas_penilaian_mandiri">Kembali</a>
                               <input class="btn btn-secondary pull-right" type="submit" name="tambah_penjelasan_indikator" value="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; 
}
?>

    <div class="row">
        <div class="col-sm-12">
        <p class="back-link">SPBE (Sistem Pemerintahan Berbasis Elektronik)</p>
        </div>
    </div>
</div>    <!--/.main-->