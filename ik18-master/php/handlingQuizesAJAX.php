<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />	
	<style>
		form {
			position:absolute;
			
			width: 400px;
			background-color: white;
			
			padding: 1em;
			border: 1px solid #CCC;
			border-radius: 1em;
		}
		form div + div {
			margin-top: 1em;
		}
		
		#emaitza {
			position:absolute;
			right:150px;
			width: 700px;
			background-color: white;
			
			padding: 1em;
			border: 1px solid #CCC;
			border-radius: 1em;
		}
	
	</style>
	</head>
	
	<body background ="../images\letras-de-modelo-37111940.jpg">
	
	
	
<form id="galderenF" name="galderenF" method="post" >

			<input type="button" value="Nire galderak erakutxi" onclick="datuakEskatu()">
			<input type="button" id="addQ" value="Galdera gehitu">
			<br><br>
			<div>
        		Email-a(*):<input type="email" id="email" name="email">
    		</div>
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
			<input type="reset" id="reset" value="Reset"/><br><br>
			*Derrigorrezkoa da informazio hori ematea <br><br>
			<?php
				if(isset($_GET['erab'])){
					$erab = $_GET['erab'];
					echo "<p> <a href='layoutErreg.php?erab=$erab'>Menura itzuli</a>";
				}
			?>
		</div>
</form>
	
<div><table id="emaitza">
		<tr><th>Zure galderak erakutsiko dira hemen.</th></tr></table>
</div>
	</body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#addQ").click(function(){
			
				if($("#email").val() == "" || $("#galdera").val() == "" || $("#erzu").val() == "" || $("#erok1").val() == "" || $("#erok2").val() == "" || $("#erok3").val() == "" || $("#arloa").val() == "" || $('input:radio[name=gz1]:checked').val() == null ){
					alert("Derrigorrezko eremuak bete");
					return false;
				}
				
				
				galdera = $("#galdera").val();
				if(galdera.trim().length<10){
					alert("Galderak 10 karaktere minimo eduki behar ditu");
					return false;
				}
				
				
				var rege = /^[a-zA-Z]{3,}[0-9]{3}@ikasle\.ehu\.eus$/;
				if(!rege.test($("#email").val())){
					alert("Hizkiak + 3 digitu + “@ikasle.ehu.eus” (EHU ikasleen eposta)");
					return false;
				}
				var url = "addQuestion.php";
				$.ajax({
					type:"POST",
					url: url,
					data: $("#galderenF").serialize(),
					success: function(){
						datuakEskatu()
					}
					
				});
				return true;
			});
		});
	
	function datuakEskatu(){
		var xhro = new XMLHttpRequest();
		xhro.onreadystatechange= function (){
			if (this.readyState == 4 && this.status == 200){
				nireFuntzioa(this);
			}
			
		};
		xhro.open("GET",'../xml/questions.xml?q='+new Date().getTime(), true);
		xhro.send();
	}
	function nireFuntzioa(xml) {
		var lortua = false;
		var i;
		var xmlDoc = xml.responseXML;
		var table="<tr><th>Egilea</th><th>Enuntziatua</th><th>Erantzun zuzena</th></tr>";
        var x = xmlDoc.getElementsByTagName("assessmentItem");
		for (i = 0; i <x.length; i++) {
			if (x[i].getAttribute("author") == "<?php echo "$erab"?>"){
				table += "<tr><td>" +
				x[i].getAttribute("author")+ "</td><td>" +
				x[i].getElementsByTagName("p")[0].childNodes[0].nodeValue +"</td><td>" +
				x[i].getElementsByTagName("value")[0].childNodes[0].nodeValue +"</td></tr>";
				lortua = true;
			}
		}
		if (lortua == false){
			table = "<tr><th>Ez daukazu galderarik</th></tr>";
		}
		document.getElementById("emaitza").innerHTML = table;
		return true;
	}	
	</script>
</html>