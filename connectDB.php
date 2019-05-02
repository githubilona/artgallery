<?php
    $conn= new PDO('mysql:host=localhost;dbname=artgallery', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>