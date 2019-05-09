<?php
$pageTitle = 'Artworks';
require_once('header.php');
?>

<main class="container">
    <?php
    require_once('connectDB.php');
    $sqlArtwork = "SELECT * FROM artwork";
    $cmd = $conn->prepare($sqlArtwork);
    $cmd->execute();
    $artworks = $cmd->fetchAll();


    echo '<div class="row">';
        foreach ($artworks as $artwork) {
            echo '<div class="column">
             <div class="content">
            <img height="350" src=' . $artwork['image'] . ' style="width:100%">
             <a href="artworkInfo.php?id_artwork='. $artwork['id_artwork'].' "> <h4>'.$artwork['title'].'</h4></a>';


            // poprawic natural join
            $artworkID =$artwork['id_artwork'];
            $sqlArtist = "SELECT first_name, last_name FROM artist NATURAL JOIN artwork WHERE id_artwork=$artworkID";
            $cmd = $conn->prepare($sqlArtist);
            $cmd->execute();
            $artist = $cmd->fetch();


            echo '<p>'.$artist['first_name']. '  '. $artist['last_name'].'</p>
            </div></div> ';
        }
    echo '</div>';

    $conn = null;
?>

</main>

<?php require_once('footer.php'); ?>
