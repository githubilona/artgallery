<?php
    $pageTitle="Artist Info";
    require_once ('header.php');
?>
<main class="container">

    <?php
    $artistID = $_GET['id_artist'];
    require_once('connectDB.php');
    $sql = "SELECT * FROM artwork NATURAL JOIN artist WHERE id_artist=:id_artist";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':id_artist', $artistID, PDO::PARAM_INT);
    $cmd->execute();
    $artist = $cmd->fetch();

       // imie nazwisko autora, informacje o autorze, obrazy autora , zdjecie (opcjonalnie), styl prac (farba, olowek)
       // tematyka
/*
    $sqlArtist = "SELECT * FROM artist NATURAL JOIN artwork WHERE id_artwork=$id_artwork";
    $cmd = $conn->prepare($sqlArtist);
    $cmd->bindParam(':id_artwork', $id_artwork, PDO::PARAM_INT);
    $cmd->execute();
    $artist = $cmd->fetch();
*/

    $conn = null;

    ?>

</main>
<?php require_once ('footer.php')?>
