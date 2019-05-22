<?php
$pageTitle='Admin artworks';
require_once ('header.php');
?>
<main class="container">
    <?php


    //Step 1 - connect to the DB
    require_once ('connectDB.php');

    //Step 2 - build the sql command
    $sql = "SELECT * FROM artworks";

    //Step 3 - bind the parameters and execute
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $users = $cmd->fetchAll();

    //create a table and display the results
    echo '<table class="table table-striped table-hover">
            <tr><th>userID</th>
                <th>username</th>
                <th>email</th>
                <th>Creation date</th>
         ';

    if (!empty($_SESSION['email'])){
        echo '<th>Edit</th>
                  <th>Delete</th>';
    }

    echo '</tr>';

    foreach($users as $user)
    {
        echo '<tr><td>'.$user['id_user'].'</td>
                      <td>'.$user['username'].'</td>
                      <td>'.$user['email'].'</td>
                      <td>'.$user['creation_date'].'</td>
                     ';

        //only show the edit and delete links if these are valid, logged in users
        if (!empty($_SESSION['email'])){
            echo '<td><a href="userInfo.php?albumID='.$user['id_user'].'"
                                class="btn btn-primary">Edit</a></td>
                      <td><a href="deleteUser.php?id_user='.$user['id_user'].'" 
                                class="btn btn-danger confirmation">Delete</a></td>';
        }
        echo '</tr>';
    }

    echo '</table></main>';



    ?>
</main>
<?php require_once ('footer.php');?>
