<?php
$pageTitle = 'Artwork info';
require_once('header.php');
?>

<main class="container">
    <?php
    $id_artwork = $_GET['id_artwork'];
    require_once('connectDB.php');
    $sql = "SELECT * FROM artwork WHERE id_artwork=:id_artwork";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':id_artwork', $id_artwork, PDO::PARAM_INT);
    $cmd->execute();
    $artworkRow = $cmd->fetch();


    $sqlArtist = "SELECT * FROM artist NATURAL JOIN artwork WHERE id_artwork=$id_artwork";
    $cmd = $conn->prepare($sqlArtist);
    $cmd->bindParam(':id_artwork', $id_artwork, PDO::PARAM_INT);
    $cmd->execute();
    $artist = $cmd->fetch();


    $conn = null;

    ?>

    <div class="img-magnifier-container">
        <?php echo '<img id="myimage" src="' . $artworkRow['image'] . '" width="600" height="600 ">'; ?>
    </div>
    <div id="info">
        <div id="title">
            <?php echo '<h2>'. $artworkRow['title'] . '</h2>
                        <h4><a href="artistInfo.php?id_artist='.$artist['id_artist'].'">'. $artist['first_name'].'  '. $artist['last_name'] . '</a></h4>    
                        ';

            ?>
        </div>
        <div id="description">
            <?php echo $artworkRow['description']; ?> <br><br><br>
            <?php echo '<p><b>Width:</b> '.$artworkRow['width'] . ' cm <br>
                <b>Height: </b>'.$artworkRow['height'].' cm<br>
                <b>Technique:</b> '.$artworkRow['technique'].'<br>
                <b>Colors:</b> '.$artworkRow['colors'].'<br>
                <b>Date made: </b>'.$artworkRow['date_made'].'<br>

            </p><br>'; ?>

        </div>
    </div>

</main>
<?php require_once('footer.php'); ?>
<script>
    /* Initiate Magnify Function
    with the id of the image, and the strength of the magnifier glass:*/
    magnify("myimage", 2);
</script>
