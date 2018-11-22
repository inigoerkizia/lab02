<?php
	require_once('../nusoap/lib/nusoap.php');
	require_once('../nusoap/lib/class.wsdlcache.php');
	
	
	$pasahitza = $_POST['pasahitza'];
	//$soapclient = new nusoap_client('http://localhost/ws18/lab02/ik18-master/php/egiaztatuPasahitza.php?wsdl',true); //lokalean
	$soapclient = new nusoap_client('https://ws18e.000webhostapp.com/Proiektua/php/egiaztatuPasahitza.php?wsdl',true); //hodeian
	
	$result = $soapclient->call('egiazPasahitz',array ('x'=>$pasahitza, 'y'=>1010));
	
	echo "$result";
			
?>