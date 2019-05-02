<?php
 echo $firstName=$_POST['firstName'];
 echo $lastName=$_POST['lastName'];
 echo $birthDate=$_POST['birthDate'];

 require('connectDB.php');

$sql="INSERT INTO artists (firstName, lastName, birthDate) VALUES (:firstName, :lastName, :birthDate)";

 $cmd= $conn->prepare($sql);
 $cmd->bindParam(':firstName', $firstName, PDO::PARAM_STR,30);
 $cmd->bindParam(':lastName', $lastName, PDO::PARAM_STR,30);
 $cmd->bindParam(':birthDate', $birthDate, PDO::PARAM_STR,30);

 $cmd->execute();
 $conn=null;
 header('location:artists.php');

?>