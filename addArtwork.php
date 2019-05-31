<?php
    $pageTitle="Add artwork";
    require_once ('header.php');
?>


<?php
if (!empty($_GET['id_artwork'])){
    $artworkID = $_GET['id_artwork'];
echo $artworkID;}
else {
    $artworkID = null;
}
$title=null;
$price=null;
$firstName=null;
$lastName=null;
$technique=null;
$colors=null;
$width=null;
$height=null;
$description=null;
$image = null;


// if the albumID exists, it is an edit situation and we need to
//load the album from the DB
if (!empty($artworkID))
{
    require_once('connectDB.php');

    $sql = "SELECT * FROM artwork NATURAL JOIN artist WHERE id_artwork = :artworkID";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':artworkID', $artworkID, PDO::PARAM_INT);
    $cmd->execute();
    $artwork= $cmd->fetch();



    $conn = null;


    $title=$artwork['title'];
    $price=$artwork['price'];
    $firstName=$artwork['first_name'];
    $lastName=$artwork['last_name'];
    $dateMade=$artwork['date_made'];
    $technique=$artwork['technique'];
    $colors=$artwork['colors'];
    $width=$artwork['width'];
    $height=$artwork['height'];
    $description=$artwork['description'];
    $image=$artwork['image'];


}
?>
<link rel="stylesheet" href="css/add-artwork.css">
<div class="container">
    <?php
    if (empty($_GET['id_exhibition'])){
        echo ' <h1>Oraganize an exhibition</h1>';
    }else{
        echo ' <h1>Edit</h1>';
    }

    ?>

<div  id="form">
    <!-- To have file input send properly I had to add enctype="multipart/form-data" 01.05.19 -->
    <form method="post" action="addArtworkAction.php" enctype="multipart/form-data">

        <fieldset class="form-group">
            <label for="image" class="col-sm-2">Image</label>
            <input name="image" id="image" type="file" onchange="readURL(this);"  />
        </fieldset>

        <fieldset class="form-group">
            <label for="title" class="col-sm-2">Title *</label>
            <input name="title" id="title" required placeholder="Title" value="<?php echo $title?>"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="firstName" class="col-sm-2">First Name</label>
            <input name="firstName" id="firstName" required placeholder="First Name" value="<?php echo $firstName?>"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="lastName" class="col-sm-2">Last Name</label>
            <input name="lastName" id="lastName" required placeholder="Last Name"value="<?php echo $lastName?>"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="dateMade" class="col-sm-2">Year made</label>
            <input type="number" name="dateMade" id="dateMade" required placeholder="Year made" min="0" value="<?php echo $dateMade?>"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="technique" class="col-sm-2">Technique</label>
            <input name="technique" id="technique" required placeholder="Technique" value="<?php echo $technique?>"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="price" class="col-sm-2">Price</label>
            <input type="number" name="price" id="price"  placeholder="Price" value="<?php echo $price?>"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="colors" class="col-sm-2">Main colors</label>
            <input name="colors" id="colors" required placeholder="Main colors" value="<?php echo $colors?>"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="width" class="col-sm-2">Width</label>
            <input type="number" name="width" id="width" required placeholder="Width" value="<?php echo $width?>"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="height" class="col-sm-2">Height</label>
            <input type="number" name="height" id="height" required placeholder="Height" value="<?php echo $height?>"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="description" class="col-sm-2">Description</label>
            <textarea rows="8" cols="60" name="description" placeholder="Enter description..." ><?php echo $description?></textarea>
        </fieldset>

        <button class="btn btn-default col-sm-offset-2">Save</button>



    </form>
</div>
    <div id="imagePreview">
        <img id="img" src="<?php echo $image?>" alt="your image" style="width: 300px" style="height: 450px;"/>
    </div>
</main>
</div>

<?php require_once ('footer.php'); ?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
