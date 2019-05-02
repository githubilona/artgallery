<?php
    $pageTitle="Add artwork";
    require_once ('header.php');
?>
<main class="container">
    <h1>Add artwork</h1>

    <!-- To have file input send properly I had to add enctype="multipart/form-data" 01.05.19 -->
    <form method="post" action="addArtworkAction.php" enctype="multipart/form-data">

        <fieldset class="form-group">
            <label for="image" class="col-sm-2">Image</label>
            <input name="image" id="image" type="file"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="technique" class="col-sm-2">Technique</label>
            <input name="technique" id="artist" required placeholder="Technique"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="description" class="col-sm-2">Description</label>
            <textarea rows="8" cols="80" name="description" placeholder="Enter description..."></textarea>
        </fieldset>

        <button class="btn btn-default col-sm-offset-2">Save</button>



    </form>
</main>

<?php require_once ('footer.php'); ?>
