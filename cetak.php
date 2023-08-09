<?php
include 'DATABASE FILE/koneksi.php';
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$mpdf->AddPage();

if (isset($_GET['tahun'])) {
    $tahun = $_GET['tahun'];

    // Query untuk Nilai Indeks
    $query = "SELECT total_nilai FROM nilai_indeks WHERE tahun = '$tahun'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);
    $total_nilai = $data['total_nilai'];
    $nilai_hasil = number_format($total_nilai, 2);

    // Predikat
    if($total_nilai >= 1 && $total_nilai < 2) {
        $predikat = 'Buruk';
    } elseif ($total_nilai >= 2 && $total_nilai < 3) {
        $predikat = 'Cukup';
    } elseif ($total_nilai >= 3 && $total_nilai < 4) {
        $predikat = 'Baik';
    } elseif ($total_nilai >= 4 && $total_nilai <= 5) {
        $predikat = 'Sangat Baik';
    }

    // Mengambil Semua Data nama domain dari tabel_penilaian berdasarkan tahun
    $query = "SELECT DISTINCT nama_domain FROM tabel_penilaian WHERE tahun = '$tahun'";
    $result = mysqli_query($koneksi, $query);
    
    $nama_domain = array(); // Array untuk menyimpan nama_domain yang sudah ditampilkan
    while ($data = mysqli_fetch_array($result)) {
        $domain = $data['nama_domain'];
    
        // Jika tahun belum ada dalam array, maka tambahkan ke dalam array dan tampilkan di dropdown
        if (!in_array($domain, $nama_domain)) {
            $nama_domain[] = $domain;
        }
    }

    $html ='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/cetak.css" />
    </head>
    <body>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3">
                        Hasil Evaluasi SPBE '. $tahun .'
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="ukuran_font_kecil" style="width: 77%;">
                        Nama Form
                    </td>
                    <td style="width: 1,5%; text-align:center;">
                        :
                    </td>
                    <td class="ukuran_font_kecil">
                        Evaluasi Penerapan SPBE '. $tahun .'
                    </td>
                </tr>
                <tr>
                    <td class="ukuran_font_kecil">
                        Tahun
                    </td>
                    <td style="text-align:center;" class="ukuran_font_kecil">
                        :
                    </td>
                    <td class="ukuran_font_kecil">
                        '. $tahun .'
                    </td>
                </tr>
                <tr>
                    <td class="ukuran_font_kecil">
                        Deskripsi
                    </td>
                    <td style="text-align:center;" class="ukuran_font_kecil">
                        :
                    </td>
                    <td class="ukuran_font_kecil">
                        Evaluasi Penerapan SPBE '. $tahun .'
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="tebal_dan_abu ukuran_font_kecil">
                        Pemerintahan Kab. Lampung Selatan
                    </td>
                </tr>
                <tr>
                    <td class="ukuran_font_kecil">
                        K/L/D
                    </td>
                    <td style="text-align:center;" class="ukuran_font_kecil">
                        :
                    </td>
                    <td class="ukuran_font_kecil">
                        Pemerintah Kabupaten
                    </td>
                </tr>
                <tr>
                    <td class="tebal_dan_abu ukuran_font_kecil">
                        Indeks SPBE
                    </td>
                    <td style="text-align:center;" class="tebal_dan_abu ukuran_font_kecil">
                        :
                    </td>
                    <td class="tebal_dan_abu ukuran_font_kecil">
                        '. $nilai_hasil .'
                    </td>
                </tr>
                <tr>
                    <td class="tebal_dan_abu ukuran_font_kecil">
                        Predikat SPBE
                    </td>
                    <td style="text-align:center;" class="tebal_dan_abu ukuran_font_kecil">
                        :
                    </td>
                    <td class="tebal_dan_abu ukuran_font_kecil">
                        '. $predikat .'
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th colspan="3">
                        Nilai Indeks
                    </th>
                </tr>
            </thead>
            <tbody>';

            foreach ($nama_domain as $nomor_domain) {
                $html .='
                <tr>
                    <td style="width: 77%;" class="lebar_tabel tebal_dan_abu ukuran_font_kecil">
                        Domain '. $nomor_domain .'
                    </td>
                    <td style="width:1,5%; text-align:center;" class="tebal_dan_abu ukuran_font_kecil">
                        :
                    </td>';

                    // Menghitung Jumlah Bobot pada Domain berdasarkan tahun
                    $jumlah = "SELECT SUM(bobot) AS jumlah_bobot FROM tabel_penilaian WHERE nama_domain = '$nomor_domain' AND tahun = '$tahun'";
                    // Eksekusi kueri
                    $hasil = $koneksi->query($jumlah);
                    $row = mysqli_fetch_assoc($hasil);
                    $jumlah_bobot = $row['jumlah_bobot'];
                    
                    // Menghitung Total Bobot pada Domain berdasarkan tahun
                    $jumlah = "SELECT SUM(total_bobot) AS total_bobot FROM tabel_penilaian WHERE nama_domain = '$nomor_domain' AND tahun = '$tahun'";
                    // Eksekusi kueri
                    $hasil = $koneksi->query($jumlah);
                    $row = mysqli_fetch_assoc($hasil);
                    $total_bobot = $row['total_bobot'];
                    if ($total_bobot != 0 && $jumlah_bobot != 0) {
                        $nilai = ($total_bobot / $jumlah_bobot) * 5;
                        $nilai_hasil = number_format($nilai, 2);
                        $html.='
                            <td class="tebal_dan_abu ukuran_font_kecil">
                                '. $nilai_hasil .'
                            </td>
                        </tr>';
                    } else {
                        $html.='
                            <td class="tebal_dan_abu ukuran_font_kecil">
                                0.00
                            </td>
                        </tr>';
                    }
                    
                    // Mengambil Semua Data nama aspek dari tabel_penilaian berdasarkan tahun
                    $query = "SELECT DISTINCT nama_aspek FROM tabel_penilaian WHERE nama_domain = '$nomor_domain' AND tahun = '$tahun'";
                    $result = mysqli_query($koneksi, $query);

                    $nama_aspek = array(); // Array untuk menyimpan nama_aspek yang sudah ditampilkan
                    while ($data = mysqli_fetch_array($result)) {
                        $aspek = $data['nama_aspek'];
                    
                        // Jika tahun belum ada dalam array, maka tambahkan ke dalam array dan tampilkan di dropdown
                        if (!in_array($aspek, $nama_aspek)) {
                            $nama_aspek[] = $aspek;
                        }
                    }
                foreach ($nama_aspek as $nomor_aspek) {                
                    $html.='
                        <tr>
                            <td class="ukuran_font_kecil">
                                '. $nomor_aspek .'
                            </td>
                            <td style="text-align:center;" class="ukuran_font_kecil">
                                :
                            </td>';
                            
                    // Menghitung Jumlah Bobot pada Aspek berdasarkan tahun
                    $jumlah = "SELECT SUM(bobot) AS jumlah_bobot FROM tabel_penilaian WHERE nama_domain = '$nomor_domain' AND nama_aspek = '$nomor_aspek' AND tahun = '$tahun'";
                    // Eksekusi kueri
                    $hasil = $koneksi->query($jumlah);
                    $row = mysqli_fetch_assoc($hasil);
                    $jumlah_bobot = $row['jumlah_bobot'];
                    // Menghitung Total Bobot pada Aspek berdasarkan tahun
                    $jumlah = "SELECT SUM(total_bobot) AS total_bobot FROM tabel_penilaian WHERE nama_domain = '$nomor_domain' AND nama_aspek = '$nomor_aspek' AND tahun = '$tahun'";
                    // Eksekusi kueri
                    $hasil = $koneksi->query($jumlah);
                    $row = mysqli_fetch_assoc($hasil);
                    $total_bobot = $row['total_bobot'];
                    if ($total_bobot != 0 && $jumlah_bobot != 0) {
                        $nilai = ($total_bobot / $jumlah_bobot) * 5;
                        $nilai_hasil = number_format($nilai, 2);
                        $html.='
                            <td class="ukuran_font_kecil">
                                '. $nilai_hasil .'
                            </td>
                        </tr>';
                    } else {
                        $html.='
                            <td class="ukuran_font_kecil">
                                0.00
                            </td>
                        </tr>';
                    }
                }
            }

            // Mengambil Semua Data nomor indikator dari tabel_penilaian berdasarkan tahun
            $query = "SELECT DISTINCT nomor_indikator FROM tabel_penilaian WHERE tahun = '$tahun'";
            $result = mysqli_query($koneksi, $query);
            $nomor_indikator = array(); // Array untuk menyimpan nomor_indikator
            while ($data = mysqli_fetch_array($result)) {
                $nomor = $data['nomor_indikator'];
                $nomor_indikator[] = $nomor;
            }

            $html .='
            </tbody>
        </table>
        <table>    
            <thead>
                <tr>
                    <th colspan="3">Rekap Tingkat Kematangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="ukuran_font_kecil" style="width: 7%; text-align:center;">No.</td>
                    <td class="ukuran_font_kecil" style="width: 70%;">Indikator</td>
                    <td class="ukuran_font_kecil" style="text-align:center;">Level</td>
                </tr>';

                foreach ($nomor_indikator as $nomor) {
                    $query = "SELECT nama_indikator FROM tabel_penilaian WHERE nomor_indikator = '$nomor' AND tahun = '$tahun'";
                    $result = mysqli_query($koneksi, $query);
                    $data = mysqli_fetch_array($result);
                    $nama_indikator = $data['nama_indikator'];

                    $html .= '
                <tr>
                    <td  class="ukuran_font_kecil" style="text-align:center;">'. $nomor .'</td>
                    <td  class="ukuran_font_kecil">'. $nama_indikator .'</td>';
                    // Menghitung Jumlah Bobot pada Indikator berdasarkan tahun
                    $jumlah = "SELECT SUM(bobot) AS jumlah_bobot FROM tabel_penilaian WHERE nomor_indikator = '$nomor' AND nama_indikator = '$nama_indikator' AND tahun = '$tahun'";
                    // Eksekusi kueri
                    $hasil = $koneksi->query($jumlah);
                    $row = mysqli_fetch_assoc($hasil);
                    $jumlah_bobot = $row['jumlah_bobot'];
                    // Menghitung Total Bobot pada Aspek berdasarkan tahun
                    $jumlah = "SELECT SUM(total_bobot) AS total_bobot FROM tabel_penilaian WHERE nomor_indikator = '$nomor' AND nama_indikator = '$nama_indikator' AND tahun = '$tahun'";
                    // Eksekusi kueri
                    $hasil = $koneksi->query($jumlah);
                    $row = mysqli_fetch_assoc($hasil);
                    $total_bobot = $row['total_bobot'];
                    if ($total_bobot != 0 && $jumlah_bobot != 0) {
                        $nilai = ($total_bobot / $jumlah_bobot) * 5;
                        $nilai_hasil = number_format($nilai, 2);
                        $html.='
                    <td  class="ukuran_font_kecil" style="text-align:center;">
                        '. $nilai_hasil .'
                    </td>
                </tr>';
                    } else {
                        $html.='
                    <td  class="ukuran_font_kecil" style="text-align:center;">
                        0.00
                    </td>
                </tr>';
                    }
                }

$html .='
            </tbody>
        </table>   
    </body>
    </html>';
}

$mpdf->WriteHTML($html);
$mpdf->Output('Evaluasi SPBE '. $tahun .' - Pemerintah Kab. Lampung Selatan.pdf', 'D');
?>