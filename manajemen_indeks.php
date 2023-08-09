<?php
include 'DATABASE FILE/koneksi.php';
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Manajemen Indeks</li>
        </ol>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center>
                    <button class="btn btn-success pull-right" style="border-radius:0%" data-toggle="modal" data-target="#tambah_domain">Tambahkan Domain</button>
                        Domain
                    </center>
                </div>
                <div class="panel-body">
                    <link rel="stylesheet" href="css/gaya.css" />
                    <?php
                    $query = "SELECT nomor_domain FROM domain";
                    $result = mysqli_query($koneksi, $query);
                                        
                    $data_nomor = array();
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $data_nomor[] = $row['nomor_domain'];
                        }
                    }
                    ?>
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th colspan="2" class="kiri">Nama Domain</th>
                                <th style="min-width: 151px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data_nomor as $nomor) : 
                            $query = "SELECT * FROM domain WHERE nomor_domain = '$nomor'";
                            $result = mysqli_query($koneksi, $query);
                            $data = mysqli_fetch_array($result);
                            $nomor_domain = $data['nomor_domain'];
                            $nama_domain = $data['nama_domain'];
                            ?>
                            <tr>
                                <td><?php echo $nomor_domain ?></td>
                                <td colspan="2" class="kiri"><?php echo $nama_domain ?></td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit_domain_<?php echo $nomor; ?>">
                                        Edit
                                    </button>
                                    <a href="index.php?proses_hapus&id=<?php echo $nomor_domain ?>&op=hapus_domain">
                                        <button class="btn btn-danger">Hapus</button>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <center>
                    <button class="btn btn-success pull-right" style="border-radius:0%" data-toggle="modal" data-target="#tambah_aspek">Tambahkan Aspek</button>
                        Aspek
                    </center>
                </div>
                <div class="panel-body">
                    <link rel="stylesheet" href="css/gaya.css" />
                    <?php
                    $query = "SELECT nomor_aspek FROM aspek";
                    $result = mysqli_query($koneksi, $query);
                                        
                    $data_nomor = array();
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $data_nomor[] = $row['nomor_aspek'];
                        }
                    }
                    ?>
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th colspan="2" class="kiri">Nama Aspek</th>
                                <th style="min-width: 151px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data_nomor as $nomor) : 
                            $query = "SELECT * FROM aspek WHERE nomor_aspek = '$nomor'";
                            $result = mysqli_query($koneksi, $query);
                            $data = mysqli_fetch_array($result);
                            $nomor_aspek = $data['nomor_aspek'];
                            $nama_aspek = $data['nama_aspek'];
                            ?>
                            <tr>
                                <td><?php echo $nomor_aspek ?></td>
                                <td colspan="2" class="kiri"><?php echo $nama_aspek ?></td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit_aspek_<?php echo $nomor; ?>">
                                        Edit
                                    </button>
                                    <a href="index.php?proses_hapus&id=<?php echo $nomor_aspek ?>&op=hapus_aspek">
                                        <button class="btn btn-danger">Hapus</button>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <center>
                    <button class="btn btn-success pull-right" style="border-radius:0%" data-toggle="modal" data-target="#tambah_indikator">Tambahkan Indikator</button>
                        Informasi Indikator
                    </center>
                </div>
                <div class="panel-body">
                    <link rel="stylesheet" href="css/gaya.css" />
                    <?php
                    $query = "SELECT nomor_indikator FROM indikator";
                    $result = mysqli_query($koneksi, $query);
                                        
                    $data_nomor = array();
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $data_nomor[] = $row['nomor_indikator'];
                        }
                    }
                    ?>
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th colspan="2" class="kiri">Nama Indikator</th>
                                <th style="min-width: 151px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data_nomor as $nomor) : 
                            $query = "SELECT * FROM indikator WHERE nomor_indikator = '$nomor'";
                            $result = mysqli_query($koneksi, $query);
                            $data = mysqli_fetch_array($result);
                            $nomor_indikator = $data['nomor_indikator'];
                            $nama_indikator = $data['nama_indikator'];
                            ?>
                            <tr>
                                <td><?php echo $nomor_indikator ?></td>
                                <td colspan="2" class="kiri"><?php echo $nama_indikator ?></td>
                                <td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah_kriteria_indikator_<?php echo $nomor; ?>">
                                        Tambah Kriteria
                                    </button>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit_indikator_<?php echo $nomor; ?>">
                                        Edit Indikator <?php echo $nomor; ?>
                                    </button>
                                    <a href="index.php?proses_hapus&id=<?php echo $nomor_indikator ?>&op=hapus_indikator">
                                        <button class="btn btn-danger">Hapus</button>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah Domain -->
    <div id="tambah_domain" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Menambahkan Data Domain</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="index.php?proses_tambah" enctype="multipart/form-data" id="tambah_domain" data-toggle="validator" role="form">
                                <div class="response"></div>
                                <div class="form-group col-lg-6">
                                    <label>Nomor Domain</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Angka" name="nomor_domain" data-error="Masukkan Data Yang Diminta" >
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Nama Domain</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Domain" name="nama_domain" data-error="Masukkan Data Yang Diminta" >
                                    <div class="help-block with-errors"></div>
                                </div>
                                <button type="submit" class="btn btn-success pull-right" name="tambah_domain">Simpan Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah Aspek -->
    <div id="tambah_aspek" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Menambahkan Data Aspek</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="index.php?proses_tambah" enctype="multipart/form-data" id="tambah_aspek" data-toggle="validator" role="form">
                                <div class="response"></div>
                                <div class="form-group col-lg-6">
                                    <label>Nomor Aspek</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Angka" name="nomor_aspek" data-error="Masukkan Data Yang Diminta" >
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Nama Aspek</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Aspek" name="nama_aspek" data-error="Masukkan Data Yang Diminta" >
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Domain</label>
                                    <div class="">
                                        <select class="form-control" name="nomor_domain" id="nomor_domain">
                                            <option value="">- Pilih Domain -</option>
                                            <?php
                                            $query = "SELECT * FROM domain ORDER BY nomor_domain ASC";
                                            $result = mysqli_query($koneksi, $query);
                                            while ($data = mysqli_fetch_array($result)) {
                                                $nama_domain = $data['nama_domain'];
                                                $nomor_domain = $data['nomor_domain'];
                                            ?>
                                            <option value="<?php echo $nomor_domain ?>" ><?php echo $nomor_domain ?>. <?php echo $nama_domain ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <button type="submit" class="btn btn-success pull-right" name="tambah_aspek">Simpan Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah Indikator -->
    <div id="tambah_indikator" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Menambahkan Data Indikator</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="index.php?proses_tambah" enctype="multipart/form-data" id="tambah_domain" data-toggle="validator" role="form">
                                <div class="response"></div>
                                <div class="form-group col-lg-6">
                                    <label>Nomor Indikator</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Angka" name="nomor_indikator" data-error="Select Check In Date" >
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Nama Indikator</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Indikator" name="nama_indikator" data-error="Select Check In Date" >
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Aspek</label>
                                    <div class="">
                                        <select class="form-control" name="nomor_aspek" id="nomor_aspek">
                                            <option value="">- Pilih Aspek -</option>
                                            <?php
                                            $query = "SELECT * FROM aspek ORDER BY nomor_aspek ASC";
                                            $result = mysqli_query($koneksi, $query);
                                            while ($data = mysqli_fetch_array($result)) {
                                                $nama_aspek = $data['nama_aspek'];
                                                $nomor_aspek = $data['nomor_aspek'];
                                            ?>
                                            <option value="<?php echo $nomor_aspek ?>" ><?php echo $nomor_aspek ?>. <?php echo $nama_aspek ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <button type="submit" class="btn btn-success pull-right" name="tambah_indikator">Simpan Data</button>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Domain -->
    <?php
    $query = "SELECT nomor_domain FROM domain";
    $result = mysqli_query($koneksi, $query);

    $data_nomor = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data_nomor[] = $row['nomor_domain'];
        }
    }
    
    foreach ($data_nomor as $nomor) :
    $query = "SELECT * FROM domain WHERE nomor_domain = '$nomor'";
    $result = mysqli_query($koneksi, $query);

    $data = mysqli_fetch_array($result);
    $nomor_domain = $data['nomor_domain'];
    $nama_domain = $data['nama_domain'];
    ?>
    <div id="edit_domain_<?php echo $nomor; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Mengedit Data Domain <?php echo $nomor ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                        <form action="index.php?proses_tambah" method="POST">
                            <input type="hidden" name="nomor_domain" value="<?php echo $nomor_domain ?>">
                            <div class="form-group col-lg-6">
                                <label>Nama Domain</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Domain Yang Baru" name="nama_domain" data-error="Masukkan Data Yang Diminta" value="<?php echo $nama_domain ?>">
                                <div class="help-block with-errors"></div>
                            </div>
                            <input class="btn btn-secondary pull-right" type="submit" name="edit_domain" value="submit">
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    
    <!-- Edit Aspek -->
    <?php
    $query = "SELECT nomor_aspek FROM aspek";
    $result = mysqli_query($koneksi, $query);

    $data_nomor = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data_nomor[] = $row['nomor_aspek'];
        }
    }
    
    foreach ($data_nomor as $nomor) :
    $query = "SELECT * FROM aspek WHERE nomor_aspek = '$nomor'";
    $result = mysqli_query($koneksi, $query);

    $data = mysqli_fetch_array($result);
    $nomor_aspek = $data['nomor_aspek'];
    $nama_aspek = $data['nama_aspek'];
    $nomor_domain_aspek = $data['nomor_domain'];
    ?>
    <div id="edit_aspek_<?php echo $nomor; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Mengedit Data Aspek <?php echo $nomor ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                        <form action="index.php?proses_tambah" method="POST">
                            <input type="hidden" name="nomor_aspek" value="<?php echo $nomor_aspek ?>">
                            <div class="form-group col-lg-6">
                                <label>Nama Aspek</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Aspek Yang Baru" name="nama_aspek" data-error="Masukkan Data Yang Diminta" value="<?php echo $nama_aspek ?>">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Domain</label>
                                <div class="">
                                    <select class="form-control" name="nomor_domain" id="nomor_domain">
                                        <option value="">- Pilih Domain -</option>
                                        <?php
                                        $query = "SELECT * FROM domain ORDER BY nomor_domain ASC";
                                        $result = mysqli_query($koneksi, $query);
                                        while ($data = mysqli_fetch_array($result)) {
                                            $nomor_domain = $data['nomor_domain'];
                                            $nama_domain = $data['nama_domain'];
                                        ?><option value="<?php echo $nomor_domain ?>"
                                        <?php
                                        if ($nomor_domain == $nomor_domain_aspek) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $nama_domain ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                            <input class="btn btn-secondary pull-right" type="submit" name="edit_aspek" value="submit">
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    
    <!-- Edit Indikator -->
    <?php
    $query = "SELECT nomor_indikator FROM indikator";
    $result = mysqli_query($koneksi, $query);

    $data_nomor = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data_nomor[] = $row['nomor_indikator'];
        }
    }
    
    foreach ($data_nomor as $nomor) :
    $query = "SELECT * FROM indikator WHERE nomor_indikator = '$nomor'";
    $result = mysqli_query($koneksi, $query);

    $data = mysqli_fetch_array($result);
    $nomor_indikator = $data['nomor_indikator'];
    $nama_indikator = $data['nama_indikator'];
    $nomor_aspek_indikator = $data['nomor_aspek'];
    ?>
    <div id="edit_indikator_<?php echo $nomor; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Mengedit Data Indikator <?php echo $nomor ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                        <form action="index.php?proses_tambah" method="POST">
                            <input type="hidden" name="nomor_indikator" value="<?php echo $nomor_indikator ?>">
                            <div class="form-group col-lg-6">
                                <label>Nama Indikator</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Indikator Yang Baru" name="nama_indikator" data-error="Masukkan Data Yang Diminta" value="<?php echo $nama_indikator ?>">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Aspek</label>
                                <div class="">
                                    <select class="form-control" name="nomor_aspek" id="nomor_aspek">
                                        <option value="">- Pilih Aspek -</option>
                                        <?php
                                        $query = "SELECT * FROM aspek ORDER BY nomor_aspek ASC";
                                        $result = mysqli_query($koneksi, $query);
                                        while ($data = mysqli_fetch_array($result)) {
                                            $nomor_aspek = $data['nomor_aspek'];
                                            $nama_aspek = $data['nama_aspek'];
                                        ?><option value="<?php echo $nomor_aspek ?>"
                                        <?php
                                        if ($nomor_aspek == $nomor_aspek_indikator) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $nama_aspek ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                            <input class="btn btn-secondary pull-right" type="submit" name="edit_indikator" value="submit">
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Tambah Kriteria Indikator -->
    <?php
    $query = "SELECT nomor_indikator FROM indikator";
    $result = mysqli_query($koneksi, $query);

    $data_nomor = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data_nomor[] = $row['nomor_indikator'];
        }
    }
    
    foreach ($data_nomor as $nomor) :
    $query = "SELECT * FROM indikator WHERE nomor_indikator = '$nomor'";
    $result = mysqli_query($koneksi, $query);

    $data = mysqli_fetch_array($result);
    $nomor_indikator = $data['nomor_indikator'];
    $nama_indikator = $data['nama_indikator'];
    $nomor_aspek_indikator = $data['nomor_aspek'];
    ?>
    <div id="tambah_kriteria_indikator_<?php echo $nomor; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Menambahkan Kriteria Indikator <?php echo $nomor ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="index.php?proses_tambah" enctype="multipart/form-data" id="tambah_kriteria_indikator" data-toggle="validator" role="form">
                                <input type="hidden" name="nomor_indikator" value="<?php echo $nomor_indikator ?>">
                                <div class="response"></div>
                                <div class="form-group col-lg-12">
                                    <label>Kriteria Tingkat 1</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Penjelasan Kriteria Sesuai Tingkatannya" name="kriteria_tingkat_1">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Kriteria Tingkat 2</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Penjelasan Kriteria Sesuai Tingkatannya" name="kriteria_tingkat_2">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Kriteria Tingkat 3</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Penjelasan Kriteria Sesuai Tingkatannya" name="kriteria_tingkat_3">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Kriteria Tingkat 4</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Penjelasan Kriteria Sesuai Tingkatannya" name="kriteria_tingkat_4">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Kriteria Tingkat 5</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Penjelasan Kriteria Sesuai Tingkatannya" name="kriteria_tingkat_5">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Bobot Indikator</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Bobot Indikator" name="bobot" data-error="Masukkan Data Yang Diminta" >
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Tahun</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Tahun Sekarang" name="tahun" data-error="Masukkan Data Yang Diminta" >
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <button type="submit" class="btn btn-success pull-right" name="tambah_kriteria_indikator">Simpan Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <div class="row">
        <div class="col-sm-12">
            <p class="back-link">SPBE (Sistem Pemerintahan Berbasis Elektronik)</p>
        </div>
    </div>

</div>    <!--/.main-->