<?php
$subject = $_POST['subject'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$description = $_POST['description'];

$country = $_POST['country'];
$city = $_POST['city'];
$street = $_POST['street'];

$homeNumber = $_POST['homeNumber'];
$flatNumber = $_POST['flatNumber'];
$postCode = $_POST['postCode'];

$ticketPrice=$_POST['price'];
session_start();
$userID=$_SESSION['id_user'];
/*
$imageName = $_FILES['image']['name'];
$imageType = $_FILES['image']['type'];
$imageTmpLocation = $_FILES['image']['tmp_name'];
*/

/*
if (empty($imageName)) {
    echo 'bla';
} else {
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
*/
require_once('connectDB.php');


for ($x = 0; $x < count($_FILES['images1']['tmp_name']); $x++) {

    $file_name = $_FILES['images1']['name'][$x];
    $file_size = $_FILES['images1']['size'][$x];
    $file_tmp = $_FILES['images1']['tmp_name'][$x];

    $t = explode(".", $file_name);
    $t1 = end($t);
    $file_ext = strtolower(end($t));

    $ext_boleh = array("jpg", "jpeg", "png", "gif", "bmp");

    if (in_array($file_ext, $ext_boleh)) {
        $sumber = $file_tmp;
        $imageName = "img/" . 'test' . $file_name;
        move_uploaded_file($sumber, $imageName);

        $sql2 = "insert into exhibition_images (image) values ('$imageName')";
        $cmd = $conn->prepare($sql2);
        $cmd->execute();
        // $artists =$cmd->fetchAll();
        // mysqli_query($koneksi, $sql);
    } else {
        echo "Only Images can be store!";
    }
} // endfor

/*
$sqlGetAddress = "SELECT id_address FROM address where first_name=:firstName && last_name=:lastName";
$cmd = $conn->prepare($sqlGetAddress);
$cmd->bindParam(':firstName', $firstName, PDO::PARAM_STR, 45);
$cmd->bindParam(':lastName', $lastName, PDO::PARAM_STR, 45);
$cmd->execute();
$artists = $cmd->fetchAll();
foreach ($artists as $artist) {
    echo 'id Artist            ' . $artist['id_artist'];
}
*/


$sqlAddress ="INSERT INTO address (country, city, street, home_number, flat_number, post_code) VALUES
(:country, :city, :street, :homeNumber, :flatNumber, :postCode )";

$cmd = $conn->prepare($sqlAddress);

$cmd->bindParam(':country', $country, PDO::PARAM_STR, 45);
//$cmd->bindParam(':author', $author, PDO::PARAM_STR,45);
$cmd->bindParam(':city', $city, PDO::PARAM_STR, 45);
$cmd->bindParam(':street', $street, PDO::PARAM_STR, 45);
$cmd->bindParam(':homeNumber', $homeNumber, PDO::PARAM_STR);
$cmd->bindParam(':flatNumber', $flatNumber, PDO::PARAM_STR);
$cmd->bindParam(':postCode', $postCode, PDO::PARAM_STR);

$cmd->execute();
$addressID = $conn->lastInsertId();


$sql = "INSERT INTO exhibition (id_address,id_user, subject,description, start_date, end_date,ticket_price, image) VALUES 
('$addressID','$userID',:subject,:description, :startDate, :endDate,:ticketPrice, :image)";

$cmd = $conn->prepare($sql);

$cmd->bindParam(':subject', $subject, PDO::PARAM_STR, 45);
//$cmd->bindParam(':author', $author, PDO::PARAM_STR,45);
$cmd->bindParam(':startDate', $startDate, PDO::PARAM_STR, 45);
$cmd->bindParam(':endDate', $endDate, PDO::PARAM_STR, 45);
$cmd->bindParam(':description', $description, PDO::PARAM_STR);
$cmd->bindParam(':ticketPrice', $ticketPrice, PDO::PARAM_STR);
$cmd->bindParam(':image', $imageName, PDO::PARAM_STR, 255);

$cmd->execute();
$exhibitionID = $conn->lastInsertId();
echo $exhibitionID;

for ($x = 0; $x < count($_FILES['images1']['tmp_name']); $x++) {

    $file_name = $_FILES['images1']['name'][$x];
    $file_size = $_FILES['images1']['size'][$x];
    $file_tmp = $_FILES['images1']['tmp_name'][$x];

    $t = explode(".", $file_name);
    $t1 = end($t);
    $file_ext = strtolower(end($t));

    $ext_boleh = array("jpg", "jpeg", "png", "gif", "bmp");

    if (in_array($file_ext, $ext_boleh)) {
        $sumber = $file_tmp;
        $imageName = "img/" . 'test' . $file_name;
        move_uploaded_file($sumber, $imageName);

        $sql = "insert into exhibition_images (id_exhibition, image) values ('$exhibitionID','$imageName')";
        $cmd = $conn->prepare($sql);
        $cmd->execute();
        // $artists =$cmd->fetchAll();
        // mysqli_query($koneksi, $sql);
    } else {
        echo "Only Images can be store!";
    }
} // endfor

$conn = null;


 header('location:exhibitions.php');

?>