<?php
$pageTitle = "Artist Info";
require_once('header.php');
?>
<link rel="stylesheet" href="css/artist-info.css">
<main class="container">

    <?php
    $artistID = $_GET['id_artist'];
    require_once('connectDB.php');

    $sqlArtist= "SELECT * from artist WHERE id_artist=:id_artist";
    $cmd = $conn->prepare($sqlArtist);
    $cmd->bindParam(':id_artist', $artistID, PDO::PARAM_INT);
    $cmd->execute();
    $artist= $cmd->fetch();


    $sql = "SELECT * FROM artwork NATURAL JOIN artist WHERE id_artist=:id_artist";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':id_artist', $artistID, PDO::PARAM_INT);
    $cmd->execute();
    $artwork = $cmd->fetchAll();


    $sql = "SELECT * FROM artwork NATURAL JOIN artist WHERE id_artist=:id_artist";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':id_artist', $artistID, PDO::PARAM_INT);
    $cmd->execute();
    $results = $cmd->fetchAll();

    // imie nazwisko autora, informacje o autorze, obrazy autora , zdjecie (opcjonalnie), styl prac (farba, olowek)
    // tematyka


        /*
            $sqlArtist = "SELECT * FROM artist NATURAL JOIN artwork WHERE id_artwork=$id_artwork";
            $cmd = $conn->prepare($sqlArtist);
            $cmd->bindParam(':id_artwork', $id_artwork, PDO::PARAM_INT);
            $cmd->execute();
            $artist = $cmd->fetch();
        */



    ?>
    <div id="container">
        <div id="text">
            <?php echo
                '<h3>'.$artist['first_name'] . ' ' . $artist['last_name'] . ' <br>' . $artist['information']. '</h3>
                <p>'.$artwork.'</p>';

            ?>
        </div>
        <div id="image">
            <?php
            foreach ($results as $result){
                echo '<img src=" '.$result['image'].' " style="float:left" width="300px" height="300px"/>';

            }
            ?>
        </div>
    </div>

</main>
<?php  $conn = null;?>
<?php require_once('footer.php') ?>
