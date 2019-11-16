<!DOCTYPE html>

    <!-- 
        This php file is to handle the SEARCHING task.
        To safely represent the content of this file please contain it in a DIV

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 12/11/2019
    -->

    <!-- Text to establish that this is the search menu -->
    <h1>Search Menu:</h1>

    <?php 
        //Establish a PHP to SQL connection via the "Connection.php" file
        require 'Connection.php';
    ?>

    <!-- Create all the input boxes that may be needed and placeholders -->
    <form action="MoviesSearch.php" method="post">
        <p>MovieID: <input type="text" name="movieID" placeholder="248"></p>
        <p>Title: <input type="text" name="title" placeholder="Dead Bang"></p>
        <p>Studio: <input type="text" name="studio" placeholder="Warner Brothers"></p>
        <p>Status: <input type="text" name="status" placeholder="Out"></p>
        <p>Sound: <input type="text" name="sound" placeholder="SUR"></p>
        <p>Versions: <input type="text" name="versions" placeholder="4:3"></p>
        <p>RecRetPrice: <input type="text" name="recRetPrice" placeholder="9.99"></p>
        <p>Rating: <input type="text" name="rating" placeholder="R"></p>
        <p>Year: <input type="text" name="year" placeholder="1989"></p>
        <p>Genre: <input type="text" name="genre" placeholder="Action/Adventure"></p>
        <p>Aspect: <input type="text" name="aspect" placeholder="1.33:1"></p>
        <p><input type="submit" name="btnSearch" value="Search" /></p>
    </form>

    <?php
        //Perform a check for search button click 
        if (isset($_POST['btnSearch'])){
            //Retreive all data from inputs and place into an array
            $searchData = [
                "movieID" => $_POST["movieID"],
                "title" => $_POST["title"],
                "studio" => $_POST["studio"],
                "status" => $_POST["status"],
                "sound" => $_POST["sound"],
                "versions" => $_POST["versions"],
                "recRetPrice" => $_POST["recRetPrice"],
                "rating" => $_POST["rating"],
                "year" => $_POST["year"],
                "genre" => $_POST["genre"],
                "aspect" => $_POST["aspect"]
            ];


            //Validate Data
            foreach($searchData as $key => $value) {
                if (empty($value)){
                    //If the Data is empty give it a wildcard value
                    $searchData[$key] = "%";
                }
            }

            //Exchange to simpler variables (Needed because php sucks)
            $movieID = $searchData["movieID"];
            $title = $searchData["title"];
            $studio = $searchData["studio"];
            $status = $searchData["status"];
            $sound = $searchData["sound"];
            $versions = $searchData["versions"];
            $recRetPrice = $searchData["recRetPrice"];
            $rating = $searchData["rating"];
            $year = $searchData["year"];
            $genre = $searchData["genre"];
            $aspect = $searchData["aspect"];

            //Increase search count query
            $sql = "UPDATE movies_tbl 
                SET searchNo = searchNo + 1
                WHERE ID LIKE \"$movieID\"
                AND title LIKE \"%$title%\"
                AND studio LIKE \"%$studio%\"
                AND status LIKE \"%$status%\"
                AND sound LIKE \"%$sound%\"
                AND versions LIKE \"%$versions%\"
                AND recRetPrice LIKE \"%$recRetPrice%\"
                AND rating like \"$rating\"
                AND year LIKE \"%$year%\"
                AND genre LIKE \"%$genre%\"
                AND aspect LIKE \"%$aspect%\"";

            //Make increase count query
            mysqli_query($conn, $sql);

            //Select data query
            $sql = "SELECT * 
                FROM movies_tbl
                WHERE ID LIKE \"$movieID\"
                AND title LIKE \"%$title%\"
                AND studio LIKE \"%$studio%\"
                AND status LIKE \"%$status%\"
                AND sound LIKE \"%$sound%\"
                AND versions LIKE \"%$versions%\"
                AND recRetPrice LIKE \"%$recRetPrice%\"
                AND rating like \"$rating\"
                AND year LIKE \"%$year%\"
                AND genre LIKE \"%$genre%\"
                AND aspect LIKE \"%$aspect%\"";

            //Make query and get result
            $result = mysqli_query($conn, $sql);

            //Check for results and iterate through them
            if(Mysqli_num_rows($result) != 0){
                

                //Create table
                echo "<table border = '1' align = 'center'>";
                echo "<th> &nbsp ID &nbsp</th>" 
                . "<th> &nbsp Title &nbsp</th>" 
                . "<th> &nbsp Studio &nbsp</th>"
                . "<th> &nbsp Status &nbsp</th>"
                . "<th> &nbsp Sound &nbsp</th>"
                . "<th> &nbsp Versions &nbsp</th>"
                . "<th> &nbsp RecRetPrice &nbsp</th>"
                . "<th> &nbsp Rating &nbsp</th>"
                . "<th> &nbsp Year &nbsp</th>"
                . "<th> &nbsp Genre &nbsp</th>"
                . "<th> &nbsp Aspect &nbsp</th>"
                . "<th> &nbsp Search Count </th>";

                //Display table data
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr><td> &nbsp" . $row['ID'] . "&nbsp </td>"
                    . "<td> &nbsp" . $row['title'] . "&nbsp </td>"
                    . "<td> &nbsp" . $row['studio'] . "&nbsp </td>" 
                    . "<td> &nbsp" . $row['status'] . "&nbsp </td>" 
                    . "<td> &nbsp" . $row['sound'] . "&nbsp </td>" 
                    . "<td> &nbsp" . $row['versions'] . "&nbsp </td>" 
                    . "<td> &nbsp" . $row['recRetPrice'] . "&nbsp </td>" 
                    . "<td> &nbsp" . $row['rating'] . "&nbsp </td>" 
                    . "<td> &nbsp" . $row['year'] . "&nbsp </td>"
                    . "<td> &nbsp" . $row['genre'] . "&nbsp </td>" 
                    . "<td> &nbsp" . $row['aspect'] . "&nbsp </td>"
                    . "<td> &nbsp" . $row['searchNo'] . "</td></tr>";
                }

                //Send table to browser
                echo "</table>";
            }
            else {
                //Report that no movies could be found
                echo "<h1>No Movies Found</h1>";
            }
        }  
    ?>
</html>