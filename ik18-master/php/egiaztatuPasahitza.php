<?php
//nusoap.php klasea gehitzen dugu

	require_once('../nusoap/lib/nusoap.php');
	require_once('../nusoap/lib/class.wsdlcache.php');
	
//soap_server motako objektua sortzen dugu
//$ns="http://localhost/ws18/lab02/ik18-master/php/egiaztatuPasahitza.php?wsdl";
$ns="https://ws18e.000webhostapp.com/Proiektua/php/egiaztatuPasahitza.php?wsdl";
$server = new soap_server;
$server->configureWSDL('egiazPasahitz',$ns);
$server->wsdl->schemaTargetNamespace=$ns;

//inplementatu nahi dugun funtzioa erregistratzen dugu
//funtzio bat baino gehiago erregistra liteke …
$server->register('egiazPasahitz', array('x'=>'xsd:string','y'=>'xsd:int'), array('z'=>'xsd:string'), $ns);
//funtzioa inplementatzen da
function egiazPasahitz($x, $y){
	$egokia = 0;
	$pasa = file("toppasswords.txt");
	foreach($pasa as $hitza){
		if(strstr($hitza,$x)){
			$egokia = 1;
			break;
		}
	}
	if($y != 1010){
		return "ZERBITZURIK GABE";
	}
	else if($egokia == 0){
		return "BALIOZKOA";
	}else{
		return "BALIOGABEA";
	}
}
//nusoap klaseko service metodoari dei egiten diogu, behin parametroak
// prestatuta daudela
if (!isset( $HTTP_RAW_POST_DATA )) {
	$HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
}
$server->service($HTTP_RAW_POST_DATA);
?>