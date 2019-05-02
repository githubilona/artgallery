
<?php
    $pageTitle = 'Artists';
    require_once('header.php');
?>
<main class="container">
<?php
    // connect to the DB
    require_once('connectDB.php');

    // create a SQL query
    $sql = "SELECT * FROM artists";

    // prepare and execute the sql command
    $cmd = $conn->prepare($sql);
    $cmd->execute();

    // store the result in a variable
    $artists =$cmd->fetchAll();

    // close the DB connection
    $conn=null;

    // display the result in a table
    echo '<table class="table table-striped table-hover"><tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Birth date</th>
    </tr>';

    foreach ($artists as $artist){
        echo '<tr><td>'. $artist['firstName']. '</td>
                  <td>'. $artist['lastName']. '</td>
                  <td>'. $artist['birthDate']. '</td>
              </tr>';
    }


?>
</main>
<?php require_once('footer.php') ?>