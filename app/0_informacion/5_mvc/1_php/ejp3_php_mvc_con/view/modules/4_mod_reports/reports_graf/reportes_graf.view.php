<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reportes Gráficos</title>
	<link rel="stylesheet" href="../../../css/bootstrap.min.css">
	<link rel="stylesheet" href="../../../css/styles_pg.css">
	<link rel="stylesheet" href="../../../css/all.css">
</head>
<body>
	<!-- Contenedor -->
	<div class="container-fluid">

		<!-- Migas de Pan -->
		<div class="row">
			<div class="col p-0">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb rounded-0 m-0 p-2">
						<li class="breadcrumb-item"><a href="../../0_mains/admin_main.html">Inicio</a></li>
						<li class="breadcrumb-item">Módulo Reportes</li>
						<li class="breadcrumb-item active" aria-current="page">Gráficos</li>
					</ol>
				</nav>
			</div>
		</div>

		<!-- Título -->
		<div class="titulo row">
			<div class="col p-2 border-bottom d-flex">
				<div class="col-7 p-0 d-flex justify-content-start align-items-center">
					<h5 class="m-0">Gráficos</h5>
				</div>
				<div class="col-5 d-flex justify-content-end align-items-center p-0">
					<a href="../reports_imp/reports_imp.html" class="btn btn-primary">Reportes Impresos</a>
				</div>				
			</div>
		</div>

		<!-- Área Principal -->
		<section class="row bg-light">
				<div class="col d-flex justify-content-center px-1 pt-1 pb-0">
					<div id="chartContainer" class="w-100"></div>
				</div>		
		</section>
	</div>
	<script src="../../../js/jquery-3.5.1.slim.min.js"></script>
	<script src="../../../js/popper.min.js"></script>
	<script src="../../../js/bootstrap.min.js"></script>	
	<script src="../../../js/canvasjs.min.js"></script>	
	<script src="../../../js/scripts_grf.js"></script>	
</body>
</html>