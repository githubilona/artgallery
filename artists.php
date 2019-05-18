
<?php
    $pageTitle = 'Artists';
    require_once('header.php');
?>
<link rel="stylesheet" href="css/artists.css">
<main class="container">
<?php
    // connect to the DB
    require_once('connectDB.php');

    // create a SQL query
    $sql = "SELECT * FROM artist";

    // prepare and execute the sql command
    $cmd = $conn->prepare($sql);
    $cmd->execute();

    // store the result in a variable
    $artists =$cmd->fetchAll();

    // close the DB connection
    $conn=null;



    foreach ($artists as $artist){
        echo '
            <div id="box">
               <a href="artistInfo.php?id_artist='.$artist['id_artist'].'">'. $artist['first_name'] .' '. $artist['last_name'].'</a>
            </div>
        ';
    }



?>
</main>
<?php require_once('footer.php') ?>