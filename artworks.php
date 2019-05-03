<?php
$pageTitle = 'Artworks';
require_once('header.php');
?>

<main class="container">
    <?php
    require_once('connectDB.php');
    $sql = "SELECT * FROM artwork";
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $artworks = $cmd->fetchAll();
    $conn = null;

    echo '<div class="row">';
        foreach ($artworks as $artwork) {
            echo '<div class="column">
             <div class="content">
            <img height="350" src=' . $artwork['image'] . ' style="width:100%">
             <a href="artworkInfo.php?id_artwork='. $artwork['id_artwork'].' "> <h4>'.$artwork['title'].'</h4></a>
            <p>'.$artwork['author'].'</p>
            </div></div> ';
        }
    echo '</div>';
?>

</main>

<?php require_once('footer.php'); ?>
