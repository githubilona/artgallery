<?php
$pageTitle='Admin artworks';
require_once ('header.php');
?>

<main class="container">
    <h4>
        <b>Admin panel</b><br>
    </h4>
    <h5>
        Artworks
    </h5>
    <?php


    //Step 1 - connect to the DB
    require_once ('connectDB.php');

    //Step 2 - build the sql command
    $sql = "SELECT * FROM artwork NATURAL JOIN artist";

    //id_artwork, id_artist, id_exhibition, title, price, date_made, technique, colors, width, height, description, image
    //Step 3 - bind the parameters and execute
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $artworks = $cmd->fetchAll();

    //create a table and display the results
    echo '<table class="table table-striped table-hover">
            <tr><th>artworkID</th>
                <th>artist</th>
                <th>exhibitionID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Year made</th>
                <th>Technique</th>
                <th>Colors</th>
                <th>Width</th>
                <th>Height</th>
                <th>Description</th>
                <th>Image</th>
         ';

    if (!empty($_SESSION['email'])){
        echo '<th>Edit</th>
                  <th>Delete</th>';
    }

    echo '</tr>';

    foreach($artworks as $artwork)
    {
        echo '<tr><td>'.$artwork['id_artwork'].'</td>
                      <td><a href="artistInfo.php?id_artist='.$artwork['id_artist'].'">'.$artwork['first_name'].' '. $artwork['last_name'].'</a></td>
                      <td>'.$artwork['id_exhibition'].'</td>
                      <td><a href="artworkInfo.php?id_artwork='.$artwork['id_artwork'].'">'.$artwork['title'].'</a></td>
                      <td>'.$artwork['price'].'</td>
                      <td>'.$artwork['date_made'].'</td>
                      <td>'.$artwork['technique'].'</td>
                      <td>'.$artwork['colors'].'</td>
                      <td>'.$artwork['width'].'</td>
                      <td>'.$artwork['height'].'</td>
                      <td>'.$artwork['description'].'</td>
                      <td><a href="artworkInfo.php?id_artwork='.$artwork['id_artwork'].'"><img height="50" src='.$artwork['image'].'></a></td>
                     ';

        //only show the edit and delete links if these are valid, logged in users
        if (!empty($_SESSION['email'])){
            echo '<td><a href="addArtwork.php?id_artwork='.$artwork['id_artwork'].'">
                                 <i class="fas fa-edit" style="font-size: 30px"></i></a></td>
                      <td><a href="deleteArtwork.php?id_artwork='.$artwork['id_artwork'].'" class="confirmation">
                                     <i class="fas fa-trash-alt" style="font-size: 30px;"></i></a></td>';
        }
        echo '</tr>';
    }

    echo '</table></main>';



    ?>
</main>
<?php require_once ('footer.php');?>
