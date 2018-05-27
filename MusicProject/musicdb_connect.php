<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "musicdb";


try {

	$connection = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);


	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	print "Connected to Musicdb successfully!";
}
catch(PDOException $e) {

	print $connection."<br />".$e->getMessage();

}
?>
