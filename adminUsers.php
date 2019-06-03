<?php
$pageTitle='Manage users';
require_once ('header.php');
?>
<main class="container">
    <h4>
        <b>Admin panel</b><br>
    </h4>
    <h5>
        Users
    </h5><br><hr style="background-color: #0f0f0f">
<?php


//Step 1 - connect to the DB
require_once ('connectDB.php');

//Step 2 - build the sql command
$sql = "SELECT * FROM user";

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
    echo '  <th>Delete</th>';
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
        echo '
                      <td><a href="deleteUser.php?id_user='.$user['id_user'].'" class="confirmation">
                      <i class="fas fa-trash-alt" style="font-size: 30px"></i></a></td>';
    }
    echo '</tr>';
}

echo '</table></main>';



?>
</main>
<?php require_once ('footer.php');?>
