<?php
$subject=$_POST['subject'];
$startDate=$_POST['startDate'];
$endDate=$_POST['endDate'];
$description=$_POST['description'];

$imageName = $_FILES['image']['name'];
$imageType = $_FILES['image']['type'];
$imageTmpLocation = $_FILES['image']['tmp_name'];

if (empty($imageName)){
    echo 'bla';
}else{
    echo '0o0o';
    //Check to ensure that the file uploaded is an image
    $validFileTypes = ['image/jpg', 'image/png', 'image/svg', 'image/gif', 'image/jpeg'];
    $fileType = mime_content_type($imageTmpLocation);

    //store the file on our server
    if (in_array($fileType, $validFileTypes)) {
        $fileName = "img/" . uniqid("", true) . "-" . $imageName;
        move_uploaded_file($imageTmpLocation, $fileName);
    }
}

require_once('connectDB.php');


$sql="INSERT INTO exhibition (subject,description, start_date, end_date, image) VALUES 
(:subject,:description, :startDate, :endDate, :image)";

$cmd= $conn->prepare($sql);

$cmd->bindParam(':subject', $subject, PDO::PARAM_STR,45);
//$cmd->bindParam(':author', $author, PDO::PARAM_STR,45);
$cmd->bindParam(':startDate', $startDate, PDO::PARAM_STR,45);
$cmd->bindParam(':endDate', $endDate, PDO::PARAM_STR,45);
$cmd->bindParam(':description', $description, PDO::PARAM_STR);
$cmd->bindParam(':image', $fileName, PDO::PARAM_STR,255);



$cmd->execute();
$conn=null;

// header('location:artworks.php');

?>