<?php
    $pageTitle="Add artwork";
    require_once ('header.php');
?>
<link rel="stylesheet" href="css/add-artwork.css">
<div class="container">
    <h1>Add artwork</h1>
<div  id="form">
    <!-- To have file input send properly I had to add enctype="multipart/form-data" 01.05.19 -->
    <form method="post" action="addArtworkAction.php" enctype="multipart/form-data">

        <fieldset class="form-group">
            <label for="image" class="col-sm-2">Image</label>
            <input name="image" id="image" type="file" onchange="readURL(this);" />
        </fieldset>

        <fieldset class="form-group">
            <label for="title" class="col-sm-2">Title</label>
            <input name="title" id="title" required placeholder="Title"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="firstName" class="col-sm-2">First Name</label>
            <input name="firstName" id="firstName" required placeholder="First Name"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="lastName" class="col-sm-2">Last Name</label>
            <input name="lastName" id="lastName" required placeholder="Last Name"/>
        </fieldset>



        <fieldset class="form-group">
            <label for="dateMade" class="col-sm-2">Date made</label>
            <input name="dateMade" id="dateMade" required placeholder="Date made"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="technique" class="col-sm-2">Technique</label>
            <input name="technique" id="technique" required placeholder="Technique"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="colors" class="col-sm-2">Main colors</label>
            <input name="colors" id="colors" required placeholder="Main colors"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="width" class="col-sm-2">Width</label>
            <input name="width" id="width" required placeholder="Width"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="height" class="col-sm-2">Height</label>
            <input name="height" id="height" required placeholder="Height"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="description" class="col-sm-2">Description</label>
            <textarea rows="8" cols="80" name="description" placeholder="Enter description..."></textarea>
        </fieldset>

        <button class="btn btn-default col-sm-offset-2">Save</button>



    </form>
</div>
    <div id="imagePreview">
        <img id="img" src="#" alt="your image" />
    </div>
</main>

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
