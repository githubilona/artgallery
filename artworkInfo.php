<?php
$pageTitle = 'Artwork info';
require_once('header.php');
?>
<main class="container">


    <h1>Image Magnifier Glass</h1>

    <p>Mouse over the image:</p>

    <?php
    $id_artwork = $_GET['id_artwork'];
    require_once('connectDB.php');
    $sql = "SELECT * FROM artwork WHERE id_artwork=:id_artwork";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':id_artwork', $id_artwork, PDO::PARAM_INT);
    $cmd->execute();
    $artworkRow = $cmd->fetchAll();
    foreach ($artworkRow as $artworkColumn) {
    }

    $conn = null;

    ?>

    <div class="img-magnifier-container">
        <?php echo '<img id="myimage" src="' . $artworkColumn['image'] . '" width="600" height="600 ">'; ?>
    </div>
    <div id="info">
        <div id="title">
            <?php echo '<h2>'. $artworkColumn['title'] . '</h2>
                        <h4>'. $artworkColumn['author']. '</h4></p>';

            ?>
        </div>
        <div id="description">
            <?php echo $artworkColumn['description']; ?>
        </div>
    </div>

</main>
<?php require_once('footer.php'); ?>
<script>
    /* Initiate Magnify Function
    with the id of the image, and the strength of the magnifier glass:*/
    magnify("myimage", 2);
</script>
