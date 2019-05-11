<?php
$pageTitle="Organize an exhibition";
require_once ('header.php');
?>
<main class="container">
    <h1>Oraganize an exhibition</h1>

    <form method="post" action="addExhibitionAction.php" enctype="multipart/form-data">

        <fieldset class="form-group">
            <label for="image" class="col-sm-2">Image</label>
            <input name="image" id="image" type="file" onchange="readURL(this);" />
        </fieldset>

        <div id="imagePreview">
            <img id="blah" src="#" alt="your image" />
        </div>

        <fieldset class="form-group">
            <label for="subject" class="col-sm-2">Subject</label>
            <input name="subject" id="subject" required placeholder="Subject"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="description" class="col-sm-2">Description</label>
            <textarea rows="8" cols="50" name="description" placeholder="Enter description..."></textarea>
        </fieldset>

        <fieldset class="form-group">
            <label for="startDate" class="col-sm-2">Start date</label>
            <input type="date" name="startDate" id="startDate" />
        </fieldset>

        <fieldset class="form-group">
            <label for="endDate" class="col-sm-2">End date</label>
            <input type="date" name="endDate" id="endDate" "/>
        </fieldset>


        <button class="btn btn-default col-sm-offset-2">Save</button>



    </form>
</main>

<?php require_once ('footer.php'); ?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
