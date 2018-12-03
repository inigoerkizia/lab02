<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />	
	<style>
	form {
    
   	margin: 0 auto;
   	width: 400px;
	background-color: white;
    
    	padding: 1em;
   	border: 1px solid #CCC;
    	border-radius: 1em;
	}
	form div + div {
    	margin-top: 1em;
	}
	
	</style>
	</head>
	
	<body background ="../images\letras-de-modelo-37111940.jpg">
<form id="galderenF" name="galderenF" action = "addQuestion.php" method="post">

    		<div>
        		Galderaren testua(*):<input type="text" id="galdera" name="galdera" >
    		</div>
		<div>
			Erantzun zuzena(*):<input type="text" id="erzu" name="erzu"><br><br>
			Erantzun okerra1(*):<input type="text" id="erok1" name="erok1"><br><br>
			Erantzun okerra2(*):<input type="text" id="erok2" name="erok2"><br><br>
			Erantzun okerra3(*):<input type="text" id="erok3" name="erok3"><br>
			 
		</div>
	
    		<div>
        		Galderaren zailtasuna(*):
				<input type="radio" id="gz1" name="gz1" value = "0">0
				<input type="radio" id="gz1" name="gz1" value = "1">1
				<input type="radio" id="gz1" name="gz1" value = "2">2
				<input type="radio" id="gz1" name="gz1" value = "3">3
				<input type="radio" id="gz1" name="gz1" value = "4">4
				<input type="radio" id="gz1" name="gz1" value = "5">5
    		</div><br>
				Galderaren gai arloa(*):<input type="text" id="arloa" name="arloa" >	
			<div><br>
			<input type="submit" id="bidali" value="Bidali"/>
			<input type="reset" id="reset" value="Reset"/><br><br>
			*Derrigorrezkoa da informazio hori ematea <br><br>
			<?php
				if(isset($_SESSION['email'])){
					echo "<p> <a href='layoutErreg.php'>Menura itzuli</a>";
				}
			
			
				if(isset($_POST["galdera"])){

					include ("dbkonfiguratu.php");

					$esteka = mysqli_connect($zerbitzaria,$erabiltzaile,$gakoa,$db);

					$email = $_SESSION['email'];
					$galdera = $_POST["galdera"];
					$erzu = $_POST["erzu"];
					$erok1 = $_POST["erok1"];
					$erok2 = $_POST["erok2"];
					$erok3 = $_POST["erok3"];
					$arloa = $_POST["arloa"];
					
					if(isset($_POST["gz1"])){
						$gz1 = $_POST["gz1"];
					}else{
						$gz1 = "";
					}
					if (empty($email) || empty($galdera) || empty($erzu) || empty($erok1) || empty($erok2) || empty($erok3) || $gz1 == "" || empty($arloa) ){
						echo 'Derrigorrezko eremuak bete!';
						echo "<br>";
						return false;
					}
					//if(!preg_match('/^[a-zA-Z]{3,}[0-9]{3}@ikasle\.ehu\.eus$/',$email)){
					//	echo 'Hizkiak + 3 digitu + “@ikasle.ehu.eus” (EHU ikasleen eposta)';
					//	return false;
					//}
					
					mysqli_query($esteka, "INSERT INTO quiz(email, galdera, erzu, erok1, erok2, erok3, gz1, arloa) VALUES ('$_SESSION[email]', '$_POST[galdera]', '$_POST[erzu]', '$_POST[erok1]', '$_POST[erok2]', '$_POST[erok3]', '$_POST[gz1]', '$_POST[arloa]')");
					echo 'Galdera gehitu da!';
					
					mysqli_close($esteka);
				}
			
			
			
				if(isset($_POST['galdera'])){
					$email = $_SESSION['email'];
					$galdera = $_POST["galdera"];
					$erzu = $_POST["erzu"];
					$erok1 = $_POST["erok1"];
					$erok2 = $_POST["erok2"];
					$erok3 = $_POST["erok3"];
					$arloa = $_POST["arloa"];
					
					$galderak = simplexml_load_file('../xml/questions.xml');
					if($galderak == false){
						echo "Errorea XML dokumentua atzitzerakoan.";
						return false;
					}

					$berria = $galderak->addChild('assessmentItem');
					$berria->addAttribute('author', $email);
					$berria->addAttribute('subject', $arloa);
					
					$body = $berria->addChild('itemBody');
					$body->addChild('p', $galdera);
					
					$correct = $berria->addChild('correctResponse');
					$correct->addChild('value', $erzu);
					
					$incorrect = $berria->addChild('incorrectResponses');
					$incorrect->addChild('value', $erok1);
					$incorrect->addChild('value', $erok2);
					$incorrect->addChild('value', $erok3);

					$galderak->asXML('../xml/questions.xml');
					echo ("  XML dokumentuan galdera gehitu da");
					//echo "<p> <a href='layoutErreg.php'>Menura itzuli</a>";
					echo "<p> <a href='showXMLQuestions.php'>XML fitxategia bistaratu</a>";
				}
			?>
		</div>
</form>
	

 
		
	</body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#galderenF").submit(function(){
			
				if($($("#galdera").val() == "" || $("#erzu").val() == "" || $("#erok1").val() == "" || $("#erok2").val() == "" || $("#erok3").val() == "" || $("#arloa").val() == "" || $('input:radio[name=gz1]:checked').val() == null ){
					alert("Derrigorrezko eremuak bete");
					return false;
				}
				
				
				galdera = $("#galdera").val();
				if(galdera.trim().length<10){
					alert("Galderak 10 karaktere minimo eduki behar ditu");
					return false;
				}
				
				
				//var rege = /^[a-zA-Z]{3,}[0-9]{3}@ikasle\.ehu\.eus$/;
				//if(!rege.test($("#email").val())){
				//	alert("Hizkiak + 3 digitu + “@ikasle.ehu.eus” (EHU ikasleen eposta)");
				//	return false;
				//}
				
				return true;
			});
		});
	</script>
</html>
