<?php
$pageTitle = 'My account';
require_once('header.php');
?>

<link rel="stylesheet" href="css/myaccount-tabs.css">
<main class="container" onload="openPage('information', this, 'green')">

    <?php

    $id_user = $_SESSION['id_user'];

    require_once('connectDB.php');


    /*
        $sqlArtist = "SELECT * FROM artist NATURAL JOIN artwork WHERE id_artwork=$id_artwork";
        $cmd = $conn->prepare($sqlArtist);
        $cmd->bindParam(':id_artwork', $id_artwork, PDO::PARAM_INT);
        $cmd->execute();
        $artist = $cmd->fetch();
    */


    ?>
    <button class="tablink" onclick="openPage('information', this, '#b4aa5a')" id="defaultOpen">Account Information</button>
    <button class="tablink" onclick="openPage('author', this, '#b4aa5a')">My exhibitions</button>
    <button class="tablink" onclick="openPage('ticket', this, '#b4aa5a')">Tickets</button>
   <!-- <button class="tablink" onclick="openPage('about', this, '#b4aa5a')">About</button> -->

    <div id="information" class="tabcontent">
        <div class="split left">
            <?php
            $sql = "SELECT * FROM user WHERE id_user=:id_user";
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $cmd->execute();
            $user = $cmd->fetch();

            echo '
            
                <label class="col-sm-3">Username: </label>    
                <label class="col-sm-offset-1" style="font-weight: normal">'.$user['username'].'</label><br>
                
                <label class="col-sm-3">Email:</label>    
                <label class="col-sm-offset-1" style="font-weight: normal">'.$user['email'].'</label><br>
                
                <label class="col-sm-3">Creation date: </label>    
                <label class="col-sm-offset-1" style="font-weight: normal">'.$user['creation_date'].'</label><br>
          
            ';
            ?>

        </div>


        <div class=" split right">

        </div>

    </div>

    <div id="author" class="tabcontent">
        <h3>My exhibitions</h3>
        <?php
        $sql = "SELECT * FROM exhibition WHERE id_user=$id_user ";
        $cmd = $conn->prepare($sql);
        $cmd->execute();
        $exhibitions = $cmd->fetchAll();
        echo '<div class="rowExhibition">';
        foreach ($exhibitions as $exhibition) {
            echo '<div class="columnExhibition">
                <div class="cardExhibition">
                
                   <div id="imageExhibition"> 
                   <img src="' . $exhibition['image'] . '" alt="image" style="width:100%">
                   </div>
                    <div class="infoExhibition">
                        <h2><a href="exhibitionInfo.php?id_exhibition='.$exhibition['id_exhibition'].'">'
                . $exhibition['subject'] . '</a> 
                        <div id="icons" style="float: right; margin-right: 20px" >
                             <a href="addExhibition.php?id_exhibition='.$exhibition['id_exhibition'].'">
                                 <i class="fas fa-edit" style="font-size: 20px"></i></a>
                      <a href="deleteExhibition.php?id_exhibition='.$exhibition['id_exhibition'].'"class="confirmation">
                                     <i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>
                        </div></h2> 
                       
                        <p class="title">CEO & Founder</p>
                        <p>' . $exhibition['description'] . '</p>
                        <p>' . $exhibition['start_date'] . '   ' . $exhibition['end_date'] . '</p>
                        
                    </div>
        
                </div>
            </div> ';
        }

        echo '</div>';

        ?>

    </div>

    <div id="ticket" class="tabcontent">
        <?php
        // TODO poprawic zapytanie
        $sql = "   
    select distinct e.subject, t.first_name, t.last_name, d.type, e.ticket_price, t.discount_ticket_price, t.quantity, d.value, t.sum, e.id_exhibition
    from user u
    left join ticket_reservation t  on u.id_user=t.id_user 
    left join exhibition e on e.id_exhibition=t.id_exhibition 
    left join discount d on d.id_discount=t.id_discount
    where u.id_user=:id_user
    group by t.id_ticket_reservation, d.id_discount order by username;
     ";

        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $cmd->execute();
        $reservations = $cmd->fetchAll();


        echo '<table class="table table-striped table-hover">
                            <tr><th>Exhibition</th>
                                <th>Quantity</th>
                                <th>Normal ticket price</th>
                                <th>Discount ticket price</th>
                                <th>Ticket type</th>
                                <th>Discount value</th>
                                <th>Sum</th>
                               ';

        echo '</tr>';
        foreach ($reservations as $reservation) {
            echo '<tr><td><a href="exhibitionInfo.php?id_exhibition='.$reservation['id_exhibition'].'">  ' . $reservation['subject'] . '</a></td>
                      <td>' . $reservation['quantity'] . '</td>
                      <td>' . $reservation['ticket_price'] . '</td>
                      <td>' . $reservation['discount_ticket_price'] . '</td>
                      <td>' . $reservation['type'] . '</td>
                      <td>' . $reservation['value'] . '</td>
                      <td  style="color:firebrick; font-weight: bold">' . $reservation['sum'] . '</td>
                     ';
        }
        echo '</table>';

        ?>
    </div>

    <div id="about" class="tabcontent">
        <h3>About</h3>
        <p>......... . . .  .  .  .   .   .   .    .    .     .      .        .       .            .                .</p>
    </div>


    <?php $conn = null;
    ?>

</main>
<?php require_once('footer.php'); ?>


<script>
    function openPage(pageName, elmnt, color) {
        // Hide all elements with class="tabcontent" by default */
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Remove the background color of all tablinks/buttons
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }

        // Show the specific tab content
        document.getElementById(pageName).style.display = "block";

        // Add the specific color to the button used to open the tab content
        elmnt.style.backgroundColor = color;
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>