<?php
$pageTitle = "Exhibitions";
require_once('header.php');
?>
<main class="container">
    <h1>Exhibitions</h1>
    <?php
    require_once('connectDB.php');
    $sql = "SELECT * FROM exhibition";
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $exhibitions = $cmd->fetchAll();
    echo '<div class="rowExhibition">';
    foreach ($exhibitions as $exhibition) {
        echo '<div class="columnExhibition">
                <div class="cardExhibition">
                   <div id="imageExhibition"> <img src="' . $exhibition['image'] . '" alt="image" style="width:100%"></div>
                    <div class="infoExhibition">
                        <h2>' . $exhibition['subject'] . '</h2>
                        <p class="title">CEO & Founder</p>
                        <p>' . $exhibition['description'] . '</p>
                        <p>' . $exhibition['start_date'] . '   ' . $exhibition['end_date'] . '</p>
                    </div>
                </div>
            </div> ';
    }
    echo '</div>';
    ?>
</main>


<?php require_once('footer.php') ?>

