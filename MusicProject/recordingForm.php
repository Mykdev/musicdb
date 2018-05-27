<?php require "musicdb_connect.php" ?>
<?php 

$genre_query = $connection->query("SELECT * from music_category");
$genres = $genre_query->fetchAll();


if(isset($_POST["save"])){
	$keys = [];
	$values = [];
	foreach($_POST as $key => $value){
		if($key != "save"){
			$keys[] = $key;			
			$values[] = is_numeric($value) ? $value : "'" . $value . "'";			
		}		
	}
		
	$sql = "INSERT INTO recording (" . implode(",", $keys) . ") VALUES(" . implode(",", $values) . ")";
	
	
	try{
		$track_query = $connection->query($sql);	
		print "New Recording has been added";
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
	   &nbsp;<a href="music_categoryForm.php">Genre Form</a>&nbsp;
	</p>
<form action="" method="post">
<table>
<tr>
	<th>Recording Title</th>
	<td><input type="text" name="recordingTitle"></td>
</tr>
<tr>
	<th>Music Category ID</th>
	<td>
		<select name="MusicCategoryID">
			<option value="0">Select Genre</option>
			<?php foreach($genres as $genre):?>
				<option value="<?php echo $genre["MusicCategoryID"]?>"><?php echo $genre["MusicCategoryDescription"] ?></option>
			<?php endforeach;?>
		</select>
	</td>
</tr>
<tr>
	<th>Producer</th>
	<td><input type="text" name="Producer"></td>
</tr>
<tr>
	<th>Recording Label</th>
	<td><input type="text" name="RecordingLabel"></td>
</tr>
<tr>
	<th>Year Released</th>
	<td><input type="text" name="YearReleased"></td>
</tr>
<tr>
	<th>Number Of Tracks</th>
	<td><input type="text" name="NumberOfTracks"></td>
</tr>

</table>
<input type="submit" name="save" value="Save">
</form>
	</body>
</html>