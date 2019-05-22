<?php
//Step 1 - connect to the DB
require_once ('connectDB.php');

//Step 2 - Create SQL query
$sql = "DELETE FROM exhibition WHERE id_exhibition = :id_exhibition";

//Step 3 - prepare & execute the SQL
$cmd = $conn->prepare($sql);
$cmd->bindParam(':id_exhibition', $_GET['id_exhibition'], PDO::PARAM_INT);
$cmd->execute();
//Step 4 - disconnect from the DB
$conn=null;

//Step 5 - redirect to the albums.php page
header('location:adminExhibitions.php');
?>
