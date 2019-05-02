<?php
    $pageTitle='Artworks';
    require_once('header.php');
?>

<main class="container">
    <?php
        require_once ('connectDB.php');
        $sql="SELECT * FROM artwork";
        $cmd=$conn->prepare($sql);
        $cmd->execute();
        $artworks=$cmd->fetchAll();
        $conn=null;

        echo '<table class="table table-striped table-hover">
            <tr><th>Image</th>
                <th>Technique</th>
                <th>Description</th> 
            </tr>';
        foreach($artworks as $artwork){
            echo'<tr>
                <td><img height="200" src='.$artwork['image'].'></td>
                <td>'. $artwork['technique'] .'</td>
                <td>'. $artwork['description'] .'</td></tr>';

        }


        echo '</table>';

    ?>

</main>

<?php require_once ('footer.php'); ?>
