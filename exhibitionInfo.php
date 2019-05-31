<?php
$pageTitle = 'Exhibition info';
require_once('header.php');
?>
<link rel="stylesheet" href="css/image-gallery.css">
<link rel="stylesheet" href="css/exhibition-info-tabs.css">
<main class="container" onload="openPage('information', this, 'green')">

    <?php
    $id_exhibition = $_GET['id_exhibition'];
    require_once('connectDB.php');
    $sql = "SELECT * FROM exhibition WHERE id_exhibition=:id_exhibition";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':id_exhibition', $id_exhibition, PDO::PARAM_INT);
    $cmd->execute();
    $exhibition = $cmd->fetch();

    $addressID = $exhibition['id_address'];
    $sql = "SELECT * FROM address WHERE id_address='$addressID'";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':id_exhibition', $id_exhibition, PDO::PARAM_INT);
    $cmd->execute();
    $address = $cmd->fetch();

    /*
        $sqlArtist = "SELECT * FROM artist NATURAL JOIN artwork WHERE id_artwork=$id_artwork";
        $cmd = $conn->prepare($sqlArtist);
        $cmd->bindParam(':id_artwork', $id_artwork, PDO::PARAM_INT);
        $cmd->execute();
        $artist = $cmd->fetch();
    */


    ?>
    <button class="tablink" onclick="openPage('information', this, '#b4aa5a')" id="defaultOpen">Information</button>
    <button class="tablink" onclick="openPage('author', this, '#b4aa5a')">Author</button>
    <button class="tablink" onclick="openPage('ticket', this, '#b4aa5a')">Tickets</button>
    <button class="tablink" onclick="openPage('about', this, '#CFB53B')">About</button>

    <div id="information" class="tabcontent">
        <div class="split left">
            <div id="title">
                <?php echo '<h2>' . $exhibition['subject'] . '</h2>'; ?>
            </div>
            <div id="description">
                <p> <?php echo $exhibition['description']; ?> </p>
            </div>
            <div id="address">
                <br><br>
                <p><b>Start date: </b> <?php echo $exhibition['start_date']; ?> </p>
                <p><b>End date: </b><?php echo $exhibition['end_date']; ?> </p>
                <br><br>
                <p><b>Where: </b> <br>
                    <?php echo $address['city']; ?> <br>
                    <?php echo $address['street'] . ' ' . $address['home_number'] . ' ' . $address['flat_number']; ?>
                    <br>
                    <?php echo $address['post_code']; ?><br>
                    <?php echo $address['country']; ?>  </p>
            </div>
            <div id="visitors">
                <p><b>Number of Visitors: </b><br>
                <?php
                $sql = " SELECT COUNT(*) as visitors FROM ticket_reservation WHERE id_exhibition=:id_exhibition";
                $cmd = $conn->prepare($sql);
                $cmd->bindParam(':id_exhibition', $id_exhibition, PDO::PARAM_INT);
                $cmd->execute();
                $visitors = $cmd->fetch();
                   echo  $visitors['visitors'];
                ?>
                </p>
            </div>
        </div>


        <div class="containerSlideshow split right">

            <?php
            $sql = "SELECT * FROM exhibition_images WHERE id_exhibition=:id_exhibition";
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':id_exhibition', $id_exhibition, PDO::PARAM_INT);
            $cmd->execute();
            $artworks = $cmd->fetchAll();
            foreach ($artworks as $artwork) {
                echo '<div class="mySlides">
                    <img src="' . $artwork['image'] . '" style="width:100%">
                 </div>';
            }
            echo '
       <!--  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
       -->
            <div class="caption-container">
                <p id="caption"></p>
            </div>';

            echo '<div class="rowSlideshow">';
            $i = 0;
            foreach ($artworks as $artwork) {
                $i++;
                echo '
               <div class="columnSlideshow">
                        <img class="demo cursor" src="' . $artwork['image'] . '" style="width:100%" onclick="currentSlide(' . $i . ')" >
               </div>';
            }
            echo '</div>';
            ?>


        </div>


    </div>

    <div id="author" class="tabcontent">
        <h3>Author</h3>
        <p>Some news this fine day!</p>

        <h1>dfnhkhuerf hekrf werf hhefb 3uwkfn3wkfn3blkfhn3wbklhfn kf 3w3 b3 wt3b o</h1>
    </div>

    <div id="ticket" class="tabcontent">
        <h3>Buy a ticket </h3>

        <?php
        $link = "ticketAction.php?id_exhibition=$id_exhibition";
        if (empty($_SESSION['email'])) {
            echo '<p>To buy a ticket you have to be logged in</p>';
            echo '<a href="login.php"><i class="fas fa-key"></i></i> Login</a>';
            echo '<p> Don\'t have an account? Register </p>';
            echo '<a href="registration.php"><i class="fas fa-user-plus"></i></i> Register</a>';


        } else {
            echo '
        <form method="post" action="' . $link . ' " enctype="multipart/form-data">

            <fieldset class="form-group">
                <label for="ticketType" class="col-sm-2">Ticket type</label>';

            $sql = "SELECT * FROM discount";
            $cmd = $conn->prepare($sql);
            $cmd->execute();
            $discounts = $cmd->fetchAll();

            echo '
            
            <select name="selectTicket">';
            foreach ($discounts as $discount) {
                echo '<option value="' . $discount['id_discount'] . '">' . $exhibition['ticket_price'] * (1 - $discount['value']) . '   ' . $discount['type'] . '</option> ';
            }
            echo ' </select><br>';
            echo '   
            </fieldset>

            <fieldset class="form-group">
                <label for="quantity" class="col-sm-2">Quantity</label>
                <input type="number" name="quantity" id="quantity" required placeholder="Quantity" onchange="createDiv()"/>
            </fieldset>
            

            <fieldset class="form-group">
                <label for="firstName" class="col-sm-2">First Name</label>
                <input name="firstName" id="firstName" required placeholder="First Name" />
            </fieldset>

            <fieldset class="form-group">
                <label for="lastName" class="col-sm-2">Last Name</label>
                <input name="lastName" id="lastName" required placeholder="Last Name"/>
            </fieldset> 
            
             <fieldset class="form-group">
                 <button onclick="showAlert()" >Buy</button>
            </fieldset> 

        </form>';


        }
        ?>
    </div>

    <div id="about" class="tabcontent">
        <h3>About</h3>
        <p>Who we are and what we do.</p>
    </div>


    <?php $conn = null;
    ?>

</main>
<?php require_once('footer.php'); ?>
<style>
    .ticketDiv{
        background-color: #4cae4c;
    }
</style>
<script>
    function createDiv(){
        var quantity=document.getElementsByName("quantity").value;
        for (var i = 0; i < quantity; i++){
            var new_div = document.createElement("div");
            new_div.className = "ticketDiv";
            document.body.appendChild(new_div);
            var divv= document.getElementsByName("quantity");
            divv.innerHTML=("HELLO HELLOHELLO HELLOHELLO HELLOHELLO HELLOHELLO HELLOHELLO HELLO");
            new_div.innerHTML="qwertyuiopasdfghjnkjnjnjnjh";
            console.log("This is repeat " + i);
        }
    }
</script>
<script>
    function showAlert() {
        alert("Thank you for your reservation! ");
    }
</script>
<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        var captionText = document.getElementById("caption");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        captionText.innerHTML = dots[slideIndex - 1].alt;
    }


    function openPage(pageName, elmnt, color) {
        // Hide all elements with class="tabcontent" by default */
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Remove the background color of all tablinks/buttons
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }

        // Show the specific tab content
        document.getElementById(pageName).style.display = "block";

        // Add the specific color to the button used to open the tab content
        elmnt.style.backgroundColor = color;
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>