<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Garatzaileen informazioa</title>
	</head>
	<body>
		<h1> Deiturak: </h1>
		<span id = "d1">Ion Molla</span>
		<br>
		<span id = "d2">Iñigo Erkizia</span>
		
		<h1> Espezialitatea: </h1>
		<span id = "e1">Konputagailuen Ingenieritza</span>
		<br>
		<span id = "e2">Konputagailuen Ingenieritza</span>
		
		<h1> Argazkiak: </h1>
		<img src='../images\sepia.jpg' width="100px"></a>
		<br>
		<img src='../images\sepia.jpg' width="100px"></a>
		
		<h1> Bizilekua: </h1>
		<span id = "b1">Orereta</span>
		<br>
		<span id = "b2">Oiartzun</span>
		<br>
	</body>
</html>

<?php
	$v1 = $_GET['var1'];
	$erab = $_GET['erab'];
	if($v1 == 1){
		echo "<p> <a href='layoutErreg.php?erab=$erab'> Hasierako menua</a>";
	}else{
		echo "<p> <a href='../layout.html'> Hasierako menua</a>";
	}
?>