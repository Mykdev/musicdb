<?php require "musicdb_connect.php" ?>
<?php 
/*$label_query = $connection->query("SELECT * from label");
$labels = $label_query->fetchAll();*/


if(isset($_POST["save"])){
	//var_dump($_POST);
	$keys = [];
	$values = [];
	foreach($_POST as $key => $value){
		if($key != "save"){
			$keys[] = $key;			
			$values[] = is_numeric($value) ? $value : "'" . $value . "'";			
		}		
	}
		
	$sql = "INSERT INTO artist (" . implode(",", $keys) . ") VALUES(" . implode(",", $values) . ")";
	
	
	try{
		$track_query = $connection->query($sql);	
		print "New Artist has been added";
	} catch(PDOException $e) {
		print $e->getMessage();	
		
	}	
	
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body style="text-align: center" bgcolor="#e7dad8">
<p>
	   &nbsp;<a href="artistInfo.php">Artist Information</a>&nbsp;
	   &nbsp;<a href="trackForm.php">Track Form</a>&nbsp;
	   &nbsp;<a href="recordingForm.php">Recording Form</a>&nbsp;
	   &nbsp;<a href="music_categoryForm.php">Genre Form</a>&nbsp;
	</p>
<form action="" method="post">
<table>
<tr>
	<th>Artist First Name</th>
	<td><input type="text" name="artistFirstName"></td>
</tr>
<tr>
	<th>Artist Middle Name</th>
	<td><input type="text" name="artistMiddleName"></td>
</tr>
<tr>
	<th>Artist Last Name</th>
	<td><input type="text" name="artistLastName"></td>
</tr>
<tr>
	<th>Artist Birth Date</th>
	<td><input type="text" name="artistBirthDate"></td>
</tr>
<tr>
	<th>Artist Birth Place</th>
	<td><input type="text" name="artistBirthPlace"></td>
</tr>

</table>
<input type="submit" name="save" value="Save">
</form>
	</body>
</html>