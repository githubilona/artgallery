<?php

session_start();


$id_exhibition = $_GET['id_exhibition'];

$exhibitionID = $_GET['id_exhibition'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$selectTicket = $_POST['selectTicket'];
$quantity = $_POST['quantity'];
$userName = $_SESSION['userName'];
$userID = $_SESSION['id_user'];
if (empty($_SESSION['email'])) {
} else {
    $email = $_SESSION['email'];
}

require_once('connectDB.php');


$sqlTicket = "SELECT * FROM discount where id_discount='$selectTicket'";
$cmd = $conn->prepare($sqlTicket);
$cmd->execute();
$discount = $cmd->fetch();

$sqlPrice = "SELECT ticket_price FROM exhibition WHERE id_exhibition='$exhibitionID' ";
$cmd = $conn->prepare($sqlPrice);
$cmd->execute();
$exhibition = $cmd->fetch();
$ticketPrice=$exhibition['ticket_price'];
$discountTicketPrice=$ticketPrice * $discount['value'];
$sum = (1 - $discount['value']) * $ticketPrice * $quantity;


$sqlReservation = "INSERT INTO ticket_reservation (id_exhibition, id_discount,ticket_price, discount_ticket_price, quantity, id_user, first_name, last_name, sum)
                    VALUES ($id_exhibition,:selectTicket,:ticket_price,:discount_ticket_price, :quantity, :id_user ,:firstName, :lastName, $sum )";
$cmd = $conn->prepare($sqlReservation);
$cmd->bindParam(':selectTicket', $selectTicket, PDO::PARAM_STR, 45);
$cmd->bindParam(':ticket_price', $ticketPrice, PDO::PARAM_STR, 45);
$cmd->bindParam(':discount_ticket_price', $discountTicketPrice, PDO::PARAM_STR, 45);
$cmd->bindParam(':quantity', $quantity, PDO::PARAM_INT, 45);
$cmd->bindParam(':id_user', $userID, PDO::PARAM_INT, 45);
$cmd->bindParam(':firstName', $firstName, PDO::PARAM_STR, 45);
$cmd->bindParam(':lastName', $lastName, PDO::PARAM_STR, 45);
$cmd->execute();

header('location:exhibitionInfo.php?id_exhibition=' . $exhibitionID . '');
?>