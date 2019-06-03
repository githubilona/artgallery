<?php
$pageTitle='Admin tickets';
require_once ('header.php');
?>

<main class="container">
    <h4>
        <b>Admin panel</b><br>
    </h4>
    <h5>
        Ticket Reservations
    </h5>
    <?php


    //Step 1 - connect to the DB
    require_once ('connectDB.php');


    $sql = "   
    select distinct e.subject, u.email, t.first_name, t.last_name, d.type, e.ticket_price, t.discount_ticket_price, t.quantity, d.value, t.sum, e.id_exhibition
    from user u
    left join ticket_reservation t  on u.id_user=t.id_user 
    left join exhibition e on e.id_exhibition=t.id_exhibition 
    left join discount d on d.id_discount=t.id_discount
    group by t.id_ticket_reservation, d.id_discount order by username;
     ";


    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $reservations = $cmd->fetchAll();


    echo '<table class="table table-striped table-hover">
                            <tr>
                                <th>User</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Exhibition</th>
                                <th>Quantity</th>
                                <th>Normal ticket price</th>
                                <th>Discount ticket price</th>
                                <th>Ticket type</th>
                                <th>Discount value</th>
                                <th>Sum</th>
                               ';

    echo '</tr>';
    foreach ($reservations as $reservation) {
        echo '<tr>
                      <td >' . $reservation['email'] . '</td>
                      <td>' . $reservation['first_name'] . '</td>
                      <td>' . $reservation['last_name'] . '</td>
                      <td><a href="exhibitionInfo.php?id_exhibition=' . $reservation['id_exhibition'] . '">  ' . $reservation['subject'] . '</a></td>
                      <td>' . $reservation['quantity'] . '</td>
                      <td>' . $reservation['ticket_price'] . '</td>
                      <td>' . $reservation['discount_ticket_price'] . '</td>
                      <td>' . $reservation['type'] . '</td>
                      <td>' . $reservation['value'] . '</td>
                      <td  style="color:firebrick; font-weight: bold">' . $reservation['sum'] . '</td>
               </tr>';
    }
    echo '</table>';

    $conn=null;
    ?>
</main>
<?php require_once ('footer.php');?>
