<!DOCTYPE html>
<html>
<body>

<?php

	$galderak=simplexml_load_file("../xml/questions.xml") or die("Error: Ezin izan da XML dokumentua kargatu.");
	
	echo '<table border=1> <tr> <th> Egilea </th> <th> Enuntziatua </th><th> Erantzun zuzena </th></tr>';
		
	foreach($galderak->children() as $galdera){
		echo"<tr>
		<td>". $galdera['author'] . "</td>
        <td>". $galdera->itemBody->p ." </td>
        <td>". $galdera->correctResponse->value ."</td>
      </tr>\n";
	}
	echo '</table>';		
	$erab = $_GET['erab'];
	echo "<p> <a href='layoutErreg.php?erab=$erab'>Menura itzuli</a>";	
?>

</body>
</html>