

<!-- load the artist that match our search terms or all if no search terms are provided-->
    <?php

    //convert the string into array
    if (!empty($searchTerms))
        $searchTerms = explode(" ", $searchTerms);

    //step 1 - connect to the database
    require_once('connectDB.php');

    //step 2 - decide which SQL command to run
    if (empty($searchTerms)) {
        $sql = "SELECT * FROM artist";
        $sqlSearchTerms = null;
    }
    else {
        $sql = "SELECT * FROM artist WHERE";
        $wordCounter = 0;

        foreach ($searchTerms as $searchTerm) {
            $sql .= " first_name LIKE ? OR last_name LIKE ? ";
            $searchTerms[$wordCounter] = "%" . $searchTerm . "%";
            $wordCounter++;

            if ($wordCounter < sizeof($searchTerms))
                $sql .= " OR ";
        }

        $sql .="ORDER BY first_name";
        //duplicate the search terms so that at run time, there are
        //enough tokens for the ?'s in the sql statement
        $sqlSearchTerms = array();
        foreach ($searchTerms as $searchTerm) {
            $sqlSearchTerms[] = $searchTerm;
            $sqlSearchTerms[] = $searchTerm;
          //  $sqlSearchTerms[] = $searchTerm;
        }
    }

    //step 3 - prepare the SQL command
    $cmd = $conn->prepare($sql);

    //step 4 - execute and store the results
    $cmd->execute($sqlSearchTerms);
    $artists = $cmd->fetchAll();

    //step 5 - disconnect from the DB
   //  $conn = null;
     ?>