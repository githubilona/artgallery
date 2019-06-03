<?php
$pageTitle = "Exhibitions";
require_once('header.php');
?>
<main class="container">
    <h1>Exhibitions</h1>
    <?php
    require_once('connectDB.php');
    $sql = "SELECT id_exhibition,subject, description, ticket_price, start_date, end_date,image, username FROM exhibition natural join user;";
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $exhibitions = $cmd->fetchAll();
    echo '<div class="rowExhibition">';
    foreach ($exhibitions as $exhibition) {
        echo '<div class="columnExhibition">
                <div class="cardExhibition">
                   <div id="imageExhibition"> <img src="' . $exhibition['image'] . '" alt="image" style="width:100%"></div>
                    <div class="infoExhibition">
                        <h2><a href="exhibitionInfo.php?id_exhibition='.$exhibition['id_exhibition'].'">'
                        . $exhibition['subject'] . '</a></h2>
                        <p class="title">' . $exhibition['username'] . '</p>
                        <p>' . $exhibition['description'] . '</p>
                        <p style="float:left; margin-right:50px"><b>Start date: &nbsp</b>' . $exhibition['start_date'] .
                        '<br><b>End date: &nbsp</b>   ' . $exhibition['end_date'] . '</p>
                        <p><b> Normal ticket price:</b> &nbsp' .$exhibition['ticket_price'].'</p>
                        
                    </div>
                </div>
            </div> ';
    }
    echo '</div>';
    ?>
</main>


<?php require_once('footer.php') ?>

