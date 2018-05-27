<?php require "musicdb_connect.php" ?>
<?php 

$artist_query = $connection->query("SELECT ArtistID,ArtistFirstName,ArtistLastName FROM artist");
$artists = $artist_query->fetchAll();

$rec_query = $connection->query("SELECT RecordingID, RecordingTitle FROM recording");
$recs = $rec_query->fetchAll();


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
		
	$sql = "INSERT INTO tracks (" . implode(",", $keys) . ") VALUES(" . implode(",", $values) . ")";
	
	
	try{
		$track_query = $connection->query($sql);	
		print "New Track has been added";
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
	   &nbsp;<a href="recordingForm.php">Recording Form</a>&nbsp;
	   &nbsp;<a href="music_categoryForm.php">Genre Form</a>&nbsp;
	</p>
<form action="" method="post">
<table>
<tr>
	<th>Artist</th>
	<td>
		<select name="ArtistID">
			<option value="0">Select Artist</option>
			<?php foreach($artists as $artist):?>
				<option value="<?php echo $artist["ArtistID"]?>"><?php echo $artist["ArtistFirstName"] . " " . $artist["ArtistLastName"] ?></option>
			<?php endforeach;?>
		</select>
	</td>
</tr>
<tr>
	<th>Recording ID</th>
	<td>
		<select name="RecordingID">
			<option value="0">Select Recording</option>
			<?php foreach($recs as $rec):?>
				<option value="<?php echo $rec["RecordingID"]?>"><?php echo $rec["RecordingTitle"] ?></option>
			<?php endforeach;?>
		</select>
	</td>
</tr>
<tr>
	<th>Track Number</th>
	<td><input type="text" name="TrackNumber"></td>
</tr>
<tr>
	<th>Track Title</th>
	<td><input type="text" name="TrackTitle"></td>
</tr>
<tr>
	<th>Track Length</th>
	<td><input type="text" name="TrackLength"></td>
</tr>

</table>
<input type="submit" name="save" value="Save">
</form>
	</body>
</html>