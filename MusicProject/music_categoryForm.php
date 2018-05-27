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
		
	$sql = "INSERT INTO music_category (" . implode(",", $keys) . ") VALUES(" . implode(",", $values) . ")";
	
	
	try{
		$track_query = $connection->query($sql);	
		print "New Music Category has been added";
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
	   &nbsp;<a href="artistForm.php">Artist Form</a>&nbsp;
	   &nbsp;<a href="trackForm.php">Track Form</a>&nbsp;
	   &nbsp;<a href="recordingForm.php">Recording Form</a>&nbsp;
	</p>
<form action="" method="post">
<table>

<tr>
	<th>Music Category Description</th>
	<td><input type="text" name="musicCategoryDescription"></td>
</tr>

</table>
<input type="submit" name="save" value="Save">
</form>
	</body>
</html>