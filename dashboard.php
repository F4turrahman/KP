<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-dashboard"></em>
			</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</div><!--/.row-->
	
	<!-- <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Dashboard</h1>
		</div>
	</div>/.row -->
	
	<br>
	
	<div class="panel panel-container">
	<?php
	include 'DATABASE FILE/koneksi.php';
	// Query untuk mengambil 5 data terbaru dari tabel, urutkan berdasarkan kolom tanggal secara descending
	$query = "SELECT tahun, total_nilai, id_nilai_indeks FROM nilai_indeks ORDER BY tahun DESC LIMIT 5";
	$result = $koneksi->query($query);

	// Siapkan array untuk menyimpan data dari database
	$dataGrafik = array();

	if ($result->num_rows > 0) {
	    while ($row = $result->fetch_assoc()) {
	        $dataGrafik[] = array(
	            "tahun" => $row["tahun"],
	            "total_nilai" => $row["total_nilai"]
	        );
	    }
	}

	// Balikkan urutan array sehingga data terbaru berada di urutan pertama
	$dataGrafik = array_reverse($dataGrafik);

	// Tutup koneksi database
	$koneksi->close();

	// Konversi data menjadi format JSON
	$dataGrafikJSON = json_encode($dataGrafik);
	?>

		<!DOCTYPE html>
		<html>
		  <head>
		    <meta charset="utf-8">
		    <title>Chartjs, PHP dan MySQL Demo Grafik Batang</title>
			<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		    <script src="js/Chart.js"></script>
		    <style type="text/css">
		            .container {
		                width: 40%;
		                margin: 15px auto;
		            }
		    </style>
		  </head>
		  <body>
				
		  	<div style="width: 90%; margin: 0 auto;">
    		    <canvas id="grafikGaris" width="400" height="200"></canvas>
    		</div>

    		<!-- Sertakan script JavaScript untuk menggambar grafik -->
    		<script>
    		    document.addEventListener("DOMContentLoaded", function() {
    		        var dataGrafik = <?php echo $dataGrafikJSON; ?>;
				
    		        var data = {
    		            labels: dataGrafik.map(item => item.tahun),
    		            datasets: [
    		                {
    		                    label: "Grafik Garis Per 5 Tahun",
    		                    data: dataGrafik.map(item => item.total_nilai),
    		                    fill: false,
    		                    borderColor: "rgb(75, 192, 192)",
    		                    tension: 1
    		                }
    		            ]
    		        };
				
    		        var config = {
    		            type: "line",
    		            data: data,
    		            options: {
    		                responsive: true,
    		                plugins: {
    		                    title: {
    		                        display: true,
    		                        text: "Grafik Garis Per 5 Tahun"
    		                    }
    		                }
    		            }
    		        };
				
    		        var grafikGaris = new Chart(document.getElementById("grafikGaris"), config);
    		    });
    		</script>
		  </body>
		</html>
	</div>
</div>	<!--/.main-->