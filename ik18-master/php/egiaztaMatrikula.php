<?php
	require_once('../nusoap/lib/nusoap.php');
	require_once('../nusoap/lib/class.wsdlcache.php');
	
	
	$email = $_GET['email'];
	$soapclient = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl',true);
	
	$result = $soapclient->call('egiaztatuE',array ('x'=>$email));
	
	echo "$result";
			
?>
