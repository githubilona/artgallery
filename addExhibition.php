<?php
$pageTitle = "Organize an exhibition";
require_once('header.php');
?>
<link rel="stylesheet" href="css/add-exhibition-form.css">
<link rel="stylesheet" href="css/image-selection.css">


<?php
if (!empty($_GET['id_exhibition'])) {
    $exhibitionID = $_GET['id_exhibition'];
} else {
    $exhibitionID = null;
}
//id_exhibition, id_address, subject, description, start_date, end_date, image
$subject = null;
$description = null;
$startDate = null;
$endDate = null;
$image = null;
$country = null;
$city = null;
$street = null;
$homeNumber = null;
$flatNumber = null;
$postCode = null;

// if the albumID exists, it is an edit situation and we need to
//load the album from the DB
if (!empty($exhibitionID)) {
    require('connectDB.php');

    $sql = "SELECT * FROM exhibition NATURAL JOIN address WHERE id_exhibition = :exhibitionID";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':exhibitionID', $exhibitionID, PDO::PARAM_INT);
    $cmd->execute();
    $exhibition = $cmd->fetch();
    $conn = null;


    $subject = $exhibition['subject'];
    $description = $exhibition['description'];
    $startDate = $exhibition['start_date'];
    $endDate = $exhibition['end_date'];
    $image = $exhibition['image'];
    $country = $exhibition['country'];
    $city = $exhibition['city'];
    $street = $exhibition['street'];;
    $homeNumber = $exhibition['home_number'];;
    $flatNumber = $exhibition['flat_number'];
    $postCode = $exhibition['post_code'];

}
?>

<main class="container">
    <h1>Oraganize an exhibition</h1>

    <form method="post" action="addExhibitionAction.php" enctype="multipart/form-data" id="addExhibitionForm">

        <!-- One "tab" for each step in the form: -->
        <div class="tab">
            <fieldset class="form-group">
                <label for="subject" class="col-sm-2">Subject</label>
                <input name="subject" id="subject" required placeholder="Subject" oninput="this.className = ''"
                       value="<?php echo $subject ?>"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="description" class="col-sm-2">Description</label>
                <textarea rows="8" cols="50" name="description" placeholder="Enter description..."
                          oninput="this.className = ''"
                          style="text-align: left"><?php echo $description ?></textarea>
            </fieldset>
        </div>


        <div class="tab">
            <fieldset class="form-group">
                <label for="files" class="col-sm-2">Select multiple files: </label>
                <input id="files" type="file" multiple name="images1[]" oninput="this.className = ''"/>
                <output id="result" style="float: left"/>
                <div id="artworkForm"></div>
            </fieldset>
        </div>

        <div class="tab">

            <fieldset class="form-group">
                <label for="startDate" class="col-sm-2">Start date</label>
                <input type="date" name="startDate" id="startDate" oninput="this.className = ''"
                       value="<?php echo $startDate ?>"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="endDate" class="col-sm-2">End date</label>
                <input type="date" name="endDate" id="endDate" oninput="this.className = ''"
                       value="<?php echo $endDate ?>"/>
            </fieldset>


            <fieldset class="form-group">
                <label for="country" class="col-sm-2">Country</label>
                <input name="country" id="country" oninput="this.className = ''" value="<?php echo $country ?>"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="city" class="col-sm-2">City</label>
                <input name="city" id="city" oninput="this.className = ''" value="<?php echo $city ?>"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="street" class="col-sm-2">Street</label>
                <input name="street" id="street" oninput="this.className = ''" value="<?php echo $street ?>"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="homeNumber" class="col-sm-2">Home number</label>
                <input name="homeNumber" id="homeNumber" oninput="this.className = ''"
                       value="<?php echo $homeNumber ?>"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="flatNumber" class="col-sm-2">Flat number</label>
                <input name="flatNumber" id="flatNumber" oninput="this.className = ''"
                       value="<?php echo $flatNumber ?>"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="postCode" class="col-sm-2">Post code</label>
                <input name="postCode" id="postCode" oninput="this.className = ''" value="<?php echo $postCode ?>"/>
            </fieldset>

        </div>
        <div class="tab">
            <h4>Tickets</h4>
            <fieldset class="form-group">
                <label for="price" class="col-sm-2">Normal ticket price: </label>
                <input type="number" name="price" id="price" oninput="this.className = ''" value="<?php echo $price ?>"
                       onchange="showPrices()"/>

                <div id="ticketPrices"> Discounts
                    <?php

                    echo '<table class="table table-striped table-hover">
                            <tr><th>Type</th>
                                <th>Discount</th>
                                <th>Requirements</th>
                                <th>Total</th>
                               ';

                    require('connectDB.php');

                    $sql = "SELECT * FROM discount";
                    $cmd = $conn->prepare($sql);
                    $cmd->execute();
                    $discounts = $cmd->fetchAll();
                    $conn = null;

                    echo '</tr>';
                    foreach ($discounts as $discount) {
                        echo '<tr><td>' . $discount['type'] . '</td>
                      <td id="value">' . $discount['value'] . '</td>
                      <td>' . $discount['requirements'] . '</td>
                      <td id="total" style="color:green; font-weight: bold" >' . 'Enter a ticket price' . '</td>
                     ';
                    }
                    echo '</table>';
                    ?>
                </div>
            </fieldset>

        </div>


        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
        </div>


        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>

    </form>

</main>

<?php require_once('footer.php'); ?>
<script>
    window.onload = function () {

        //Check File API support
        if (window.File && window.FileList && window.FileReader) {
            var filesInput = document.getElementById("files");

            filesInput.addEventListener("change", function (event) {

                var files = event.target.files; //FileList object
                var output = document.getElementById("result");

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];

                    //Only pics
                    if (!file.type.match('image'))
                        continue;

                    var picReader = new FileReader();

                    picReader.addEventListener("load", function (event) {

                        var picFile = event.target;

                        var div = document.createElement("div");
                        var div2 = document.createElement("div2");


                        div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                            "title='" + picFile.name + "'/><br><br>";

                        div2.innerHTML = "<input type='text'><br>" +
                            "<input type='text'<br><br>";

                        output.insertBefore(div, null);

                        // TODO add form for each image
                        //     output.insertBefore(div2, null);
                        //     document.getElementById("artworkResult").appendChild(div2);


                    });

                    //Read the image
                    picReader.readAsDataURL(file);
                }

            });
        } else {
            console.log("Your browser does not support File API");
        }
    }


    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form ...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        // ... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        // ... and run a function that displays the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
            //...the form gets submitted:
            document.getElementById("addExhibitionForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false:
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
    }


</script>
<script>
    function showPrices() {

        var inputPrice = document.getElementById("price");
        var value = parseFloat(document.getElementById("value").textContent);
        var normalPrice = parseFloat(inputPrice.value).toFixed(2);
        var studentPrice = (normalPrice * value).toFixed(2);
        var kidPrice = (normalPrice * value).toFixed(2);
        var seniorPrice = (normalPrice * 0.6).toFixed(2);


        var div = document.getElementById("total");
        div.innerHTML =
            "Normal price " + normalPrice + "</br>" +
            "Student 40%" + studentPrice + "</br>" +
            "Kid 50%" + kidPrice + "</br>" +
            "60+ Senior  60%" + seniorPrice;
        var td = document.getElementsByTagName("td");
        var tdValue = '';
        for (var i = 0; i < td.length; i++) {
            if (td[i].id == "value") {
                tdValue = ((1.00 - parseFloat(td[i].textContent)) * normalPrice).toFixed(2);
            }
            if (td[i].id == "total") {
                td[i].innerHTML = tdValue;
            }

        }

    }
</script>

