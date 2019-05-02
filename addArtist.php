<?php
    $pageTitle='Add artist';
    require_once('header.php')
?>
<main class="container">
    <h1>Add artist</h1>

    <form method="post" action="addArtistAction.php">
        <fieldset class="form-group">
            <label for="firstName" class="col-sm-1"> First name: </label>
            <input name="firstName" id="firstName" placeholder="First name"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="lastName" class="col-sm-1"> Last name: </label>
            <input name="lastName" id="lastName" placeholder="Last name"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="birthDate" class="col-sm-1"> Birth date:  </label>
            <input name="birthDate" id="birthDate" placeholder="Birth date"/>
        </fieldset>

        <fieldset class="form-group" >
            <button class="col-sm-offset-1"> Submit</button>
        </fieldset>
    </form>
</main>
<?php
require_once('footer.php');
?>