<?php
//Step 1 - connect to the DB
require_once ('connectDB.php');

//Step 2 - Create SQL query
$sql = "DELETE FROM artwork WHERE id_artwork = :id_artwork";

//Step 3 - prepare & execute the SQL
$cmd = $conn->prepare($sql);
$cmd->bindParam(':id_artwork', $_GET['id_artwork'], PDO::PARAM_INT);
$cmd->execute();
//Step 4 - disconnect from the DB
$conn=null;

//Step 5 - redirect to the albums.php page
header('location:adminArtworks.php');
?>
