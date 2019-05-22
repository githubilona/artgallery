<?php
$pageTitle='Admin artworks';
require_once ('header.php');
?>

<main class="container">
    <?php


    //Step 1 - connect to the DB
    require_once ('connectDB.php');

    //Step 2 - build the sql command
    $sql = "SELECT * FROM exhibition NATURAL JOIN address";

  //id_exhibition, id_address, subject, description, start_date, end_date, image
    //Step 3 - bind the parameters and execute
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $artworks = $cmd->fetchAll();

    //create a table and display the results
    echo '<table class="table table-striped table-hover">
            <tr>
                <th>ExhibitionID</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Address</th>
                <th>Start_date</th>
                <th>End date</th>
                <th>Image</th>
         ';

    if (!empty($_SESSION['email'])){
        echo '<th>Edit</th>
                  <th>Delete</th>';
    }

    echo '</tr>';

    foreach($artworks as $exhibition)
    {
        echo '<tr>
                      <td>'.$exhibition['id_exhibition'].'</td>
                      <td><a href="exhibitionInfo.php?id_exhibition='.$exhibition['id_exhibition'].'">'. $exhibition['subject'].'</a></td>
                      <td style="text-align: left">'.$exhibition['description'].'</td>
                      <td>'.$exhibition['city']. ' '.$exhibition['street'].' '.$exhibition['home_number']. '</td>
                      <td>'.$exhibition['start_date'].'</td>
                      <td>'.$exhibition['end_date'].'</td>
                      <td><a href="exhibitionInfo.php?id_exhibition='.$exhibition['id_exhibition'].'"><img height="50" src='.$exhibition['image'].'></a></td>
                     ';

        //only show the edit and delete links if these are valid, logged in users
        if (!empty($_SESSION['email'])){
            echo '<td><a href="addExhibition.php?id_exhibition='.$exhibition['id_exhibition'].'">
                            <i class="fas fa-edit" style="font-size: 30px"></i></a></td>
                      <td "><a href="deleteExhibition.php?id_exhibition='.$exhibition['id_exhibition'].'" >
                      <i class="fas fa-trash-alt" style="font-size: 30px"></i></a></td>';
        }
        echo '</tr>';
    }

    echo '</table></main>';



    ?>
</main>
<?php require_once ('footer.php');?>
