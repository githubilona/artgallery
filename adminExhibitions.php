<?php
$pageTitle='Admin artworks';
require_once ('header.php');
?>

<main class="container">
    <?php


    //Step 1 - connect to the DB
    require_once ('connectDB.php');

    //Step 2 - build the sql command
    $sql = "
SELECT e.id_exhibition, e.subject, e.description, e.start_date, e.end_date,image, a.city, a.street, a.home_number, COUNT(*) as sold_tickets
	FROM ticket_reservation t
	left join exhibition e on e.id_exhibition=t.id_exhibition
	left join address a on e.id_address=a.id_address
	group by e.id_exhibition
UNION
SELECT   e.id_exhibition, e.subject, e.description, e.start_date, e.end_date,image, a.city, a.street, a.home_number, 0 as sold_tickets 
	FROM exhibition e  left join address a on e.id_address=a.id_address join  ticket_reservation t
	where e.id_exhibition not in (SELECT e.id_exhibition
		FROM ticket_reservation t
		left join exhibition e on e.id_exhibition=t.id_exhibition
		left join address a on e.id_address=a.id_address
		group by e.id_exhibition)
group by e.id_exhibition;      ";

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
                <th>Number of sold tickets</th>
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
                      <td>'.$exhibition['sold_tickets'].'</td>
                      <td><a href="exhibitionInfo.php?id_exhibition='.$exhibition['id_exhibition'].'"><img height="50" src='.$exhibition['image'].'></a></td>
                     ';

        //only show the edit and delete links if these are valid, logged in users
        if (!empty($_SESSION['email'])){
            echo '<td><a href="addExhibition.php?id_exhibition='.$exhibition['id_exhibition'].'">
                            <i class="fas fa-edit" style="font-size: 30px"></i></a></td>
                      <td "><a href="deleteExhibition.php?id_exhibition='.$exhibition['id_exhibition'].'" class="confirmation">
                      <i class="fas fa-trash-alt" style="font-size: 30px"></i></a></td>';
        }
        echo '</tr>';
    }

    echo '</table></main>';



    ?>
</main>
<?php require_once ('footer.php');?>
