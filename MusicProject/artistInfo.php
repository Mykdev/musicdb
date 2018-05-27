<?php require "musicdb_connect.php" ?>
<?php

$artist_query = $connection->query("SELECT ArtistID,ArtistFirstName,ArtistLastName FROM artist");
$artists = $artist_query->fetchAll();

if(isset($_POST["submit"])){

	$sql = "SELECT * FROM artist INNER JOIN tracks on tracks.ArtistID=artist.ArtistID INNER JOIN recording on recording.RecordingID=tracks.RecordingID INNER JOIN music_category on music_category.MusicCategoryID=recording.MusicCategoryID WHERE artist.ArtistID=".$_POST["ArtistID"];	
	function collect_info($info){
		$artist_info = [];
		$artist_info["name"] = $info[0]["ArtistFirstName"]." ".$info[0]["ArtistMiddleName"]." ".$info[0]["ArtistLastName"];
		$artist_info["dob"] =  $info[0]["ArtistBirthDate"] . " (" . $info[0]["ArtistBirthPlace"] . ")";
		foreach($info as $track){
			$album = $track["RecordingID"];
			$artist_info["albums"][$album]["title"] = $track["RecordingTitle"] . " (" . $track["YearReleased"] . ")";
			$artist_info["albums"][$album]["label"] = $track["RecordingLabel"];
			$artist_info["albums"][$album]["genre"] = $track["MusicCategoryDescription"];
			$artist_info["albums"][$album]["tracks"][] = $track;
		}
		
		return $artist_info;
	}
	
	try{
		$info_query = $connection->query($sql);
		$info = $info_query->fetchAll();
		$artist_info = collect_info($info);
				
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
	   &nbsp;<a href="artistForm.php">Artist Form</a>&nbsp;
	   &nbsp;<a href="trackForm.php">Track Form</a>&nbsp;
	   &nbsp;<a href="recordingForm.php">Recording Form</a>&nbsp;
	   &nbsp;<a href="music_categoryForm.php">Genre Form</a>&nbsp;
	</p>
	<p>&nbsp;</p>
	<p>Welcome to online music collection database here you can view and add artists, their tracks, recordings and music genres.</p>
		<h1>Artist Info</h1>
		<form action="" method="post">
			<select name="ArtistID">
			<option value="0">Select Artist</option>
			<?php foreach($artists as $artist):?>
				<option value="<?php echo $artist["ArtistID"]?>"><?php echo $artist["ArtistFirstName"] . " " . $artist["ArtistLastName"] ?></option>
			<?php endforeach;?>
		</select>
		</br></br>
		<input type="submit" name="submit" value="Submit">

		</form>
		
		<?php if(!empty($artist_info)):?>
			<h2><?php echo $artist_info["name"]?></h2>
			<p><strong>DOB:</strong><?php echo $artist_info["dob"]?></p>
			<h3>Discography</h3>
			<?php foreach ($artist_info["albums"] as $album):?>
				<p><strong>Recording:</strong><?php echo $album["title"]?></p>
				<p><strong>Genre:</strong><?php echo $album["genre"]?></p>
				<p><strong>Label:</strong><?php echo $album["label"]?></p>
				<table style=" margin: auto">
					<tr>
						<th>Track Number</th>
						<th>Track Title</th>
						<th>Track Length</th>				
					</tr>			
					<?php foreach ($album["tracks"] as $track):?>
					
						<tr>
							<td><?php echo $track["TrackNumber"]?></td>
							<td><?php echo $track["TrackTitle"]?></td>
							<td><?php echo $track["TrackLength"]?></td>				
						</tr>
					<?php endforeach;?>
				</table>
			<?php endforeach;?>
		<?php endif;?>
		
		
	</body>
</html>