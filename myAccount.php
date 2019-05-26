<?php
$pageTitle = 'My account';
require_once('header.php');
?>

<link rel="stylesheet" href="css/exhibition-info-tabs.css">
<main class="container" onload="openPage('information', this, 'green')">

    <?php

    $id_user = $_SESSION['id_user'];

    $id_exhibition = $_GET['id_exhibition'];
    require_once('connectDB.php');
    $sql = "SELECT * FROM exhibition WHERE id_exhibition=:id_exhibition";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':id_exhibition', $id_exhibition, PDO::PARAM_INT);
    $cmd->execute();
    $exhibition = $cmd->fetch();

    $addressID = $exhibition['id_address'];
    $sql = "SELECT * FROM address WHERE id_address='$addressID'";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':id_exhibition', $id_exhibition, PDO::PARAM_INT);
    $cmd->execute();
    $address = $cmd->fetch();

    /*
        $sqlArtist = "SELECT * FROM artist NATURAL JOIN artwork WHERE id_artwork=$id_artwork";
        $cmd = $conn->prepare($sqlArtist);
        $cmd->bindParam(':id_artwork', $id_artwork, PDO::PARAM_INT);
        $cmd->execute();
        $artist = $cmd->fetch();
    */


    ?>
    <button class="tablink" onclick="openPage('information', this, '#b4aa5a')" id="defaultOpen">Account Information</button>
    <button class="tablink" onclick="openPage('author', this, '#b4aa5a')"></button>
    <button class="tablink" onclick="openPage('ticket', this, '#b4aa5a')">Tickets</button>
    <button class="tablink" onclick="openPage('about', this, '#CFB53B')">About</button>

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


        <div class="containerSlideshow split right">

        </div>

    </div>

    <div id="author" class="tabcontent">
        <h3>Author</h3>
        <p>Some news this fine day!</p>

        <h1>dfnhkhuerf hekrf werf hhefb 3uwkfn3wkfn3blkfhn3wbklhfn kf 3w3 b3 wt3b o</h1>
    </div>

    <div id="ticket" class="tabcontent">
        <?php
        echo 'id user  ' . $id_user;
        $sql = "SELECT subject,first_name, last_name, type,ticket_price,quantity, value,sum FROM user NATURAL JOIN ticket_reservation NATURAL JOIN discount NATURAL JOIN exhibition WHERE id_user=:id_user";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $cmd->execute();
        $reservations = $cmd->fetchAll();


        echo '<table class="table table-striped table-hover">
                            <tr><th>Exhibition</th>
                                <th>Quantity</th>
                                <th>Normal ticket price</th>
                                <th>Ticket type</th>
                                <th>Discount value</th>
                                <th>Sum</th>
                               ';

        echo '</tr>';
        foreach ($reservations as $reservation) {
            echo '<tr><td>' . $reservation['subject'] . '</td>
                      <td>' . $reservation['quantity'] . '</td>
                      <td>' . $reservation['ticket_price'] . '</td>
                      <td>' . $reservation['type'] . '</td>
                      <td>' . $reservation['value'] . '</td>
                      <td>' . $reservation['sum'] . '</td>
                      <td id="total" style="color:green; font-weight: bold" >' . 'Enter a ticket price' . '</td>
                     ';
        }
        echo '</table>';

        ?>
    </div>

    <div id="about" class="tabcontent">
        <h3>About</h3>
        <p>Who we are and what we do.</p>
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