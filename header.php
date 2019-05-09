<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle?></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- font awesome -->
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond|Playfair+Display" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/side-bar.css">
    <link rel="stylesheet" href="css/artworks.css">
    <link rel="stylesheet" href="css/magnifier-glass.css">


</head>
<body>

<div class="sidebar">

    <?php
    session_start();
    if (!empty($_SESSION['email'])) {


        echo '<div id="userSection">
        '.$_SESSION['email'].'
        <a href="addArtwork.php"><i class="far fa-circle"></i></i> Add Artwork</a>
        <a href="#contact"><i class="fas fa-user-circle"></i></i></i> My account</a>
        <a href="logout.php"><i class="fas fa-power-off"></i></i> Logout</a>
        </div>';


        //add the user name to the navigation bar
       // echo '<li><div class="navbar-text pull-right">' . $_SESSION['userName'] . '</div></li>';
    }else{
        echo '<a href="registration.php"><i class="fas fa-user-plus"></i></i> Register</a>';
        echo '<a href="login.php"><i class="fas fa-key"></i></i> Login</a>';

    }

    ?>

    <a href="artworks.php"><i class="fa fa-fw fa-home"></i> Home</a>
    <a href="artworks.php"><i class="fas fa-palette"></i></i> Artworks</a>
    <a href="artists.php"><i class="far fa-circle"></i></i> Artists</a>
    <a href="#contact"><i class="fa fa-fw fa-envelope"></i> Contact</a>'




</div>
