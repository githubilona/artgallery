<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save Contact</title>
</head>
<body>
<h1>Saving contact...</h1>

<?php
$firstName = $_POST['firstName'];
echo 'First Name: '. $firstName .'<br />';

$lastName = $_POST['lastName'];
echo 'Last Name: '. $lastName .'<br />';

$email = $_POST['email'];
echo 'Email: '. $email .'<br />';

echo 'This was uploaded to the web server';

//send the first name, last name and email to the database
//Step 1 - connect to the database
$conn = new PDO('mysql:host=localhost;dbname=php','root','');
echo 'made established DB connection';

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo 'made it to step 2 create sql statement';
//Step 2 - create the SQL statement
$sql = "INSERT INTO contacts (firstName, lastName, email) 
                VALUES (:firstName, :lastName, :email)";

//Step 3 - prepare the SQL statement to prevent SQL Injection attacks
$cmd = $conn->prepare($sql);
$cmd->bindParam(':firstName', $firstName, PDO::PARAM_STR, 30);
$cmd->bindParam(':lastName', $lastName, PDO::PARAM_STR, 30);
$cmd->bindParam(':email', $email, PDO::PARAM_STR, 120);

echo 'made it to step 4 execute';
//Step 4 - exectute the SQL command
$cmd->execute();

//Step 5 - disconnect from the database
$conn = null;

//Step 6 - redirect to another web page
header('location:contacts.php');
?>

</body>
</html>
