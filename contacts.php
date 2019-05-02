<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Contacts </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
    // 1. connect to the database
    $conn = new PDO('mysql:host=localhost;dbname=php', 'root','');

    // 2. Create the sql command
    $sql="SELECT * FROM contacts";

    // 3. prepare the sql statement
    $cmd = $conn->prepare($sql);

    // 4. execute the command
    $cmd->execute();

    // 5. store the result in global array
    $contacts = $cmd->fetchAll();

    // 6. close db connection
    $conn = null;

    //7. Loop over the result array and display it on the screen
echo '<table class="table table-striped table-hover">
 <tr><th>First Name</th><th>Last Name</th><th>Email</th>';
    foreach ($contacts as $contact){
        echo '<tr><td>' . $contact['firstName'] . '</td>
            <td> ' .$contact['lastName'] . ' </td>
            <td>'. $contact['email'] . '</td></tr>';

    }
echo '</table>';

    ?>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>