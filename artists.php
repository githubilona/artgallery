
<?php
    $pageTitle = 'Artists';
    require_once('header.php');
?>
<link rel="stylesheet" href="css/artists.css">
<main class="container">

    <?php
    if (!empty($_GET['searchTerms']))
        $searchTerms = $_GET['searchTerms'];
    else
        $searchTerms = null;
    ?>

    <form action="artists.php" class="formSpace form-inline">
        <div class="form-group">
            <input class="form-control" name="searchTerms" id="searchTerms"
                   value="<?php echo $searchTerms ?>"/>
        </div>
        <button class="btn btn-default">Search</button>
    </form>
    <br />


<?php
    require_once ('searchArtist.php');
//create a table and display the results

    foreach ($artists as $artist){
        echo '
            <div id="box">
               <a href="artistInfo.php?id_artist='.$artist['id_artist'].'">'. $artist['first_name'] .' '. $artist['last_name'].'</a>
            </div> 
        ';
    }

    // TODO Add edit and delete functionality for the administrator
    /* if (!empty($_SESSION['email'])){
        echo '<th>Edit</th>
                  <th>Delete</th>';
    }
        //only show the edit and delete links if these are valid, logged in users
       if (!empty($_SESSION['email'])){
            echo '<td><a href="AlbumDetails.php?albumID='.$artist['albumID'].'"
                                class="btn btn-primary">Edit</a></td>
                      <td><a href="deleteAlbum.php?albumID='.$album['albumID'].'"
                                class="btn btn-danger confirmation">Delete</a></td>';
        }
    */
    ?>

</main>
<?php require_once('footer.php') ?>