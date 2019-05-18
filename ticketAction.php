<?php

    session_start();
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $selectTicket=$_POST['selectTicket'];
    if (empty($_SESSION['email'])) {
        $email=$_POST['email'];
    } else{
        $email=$_SESSION['email'];
    }

    require_once('connectDB.php');

    echo $firstName . '  ' . $lastName . '  ' . $email . '  ' . $selectTicket;
    $userID= $_SESSION['userName'];
    $sqlTicket = "SELECT * FROM ticket where id_ticket='$selectTicket'";
    $cmd= $conn->prepare($sqlTicket);
    $cmd->execute();
    $ticket = $cmd->fetch();

    $sum = $ticket['price'];
    echo 'Price '. $sum;


    $sqlReservation ="INSERT INTO ticket_reservation (id_ticket, id_user, first_name, last_name, email, sum)
                    VALUES (:selectTicket,1,:firstName, :lastName, :email, $sum )";
    $cmd= $conn->prepare($sqlReservation);
    $cmd->bindParam(':selectTicket', $selectTicket, PDO::PARAM_STR,45);
    $cmd->bindParam(':firstName', $firstName, PDO::PARAM_STR,45);
    $cmd->bindParam(':lastName', $lastName, PDO::PARAM_STR,45);
    $cmd->bindParam(':email', $email, PDO::PARAM_STR,45);
    $cmd->execute();
?>