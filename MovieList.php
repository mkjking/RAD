<!DOCTYPE html>

    <!-- 
        This php file is to handle the SEARCHING task.
        To safely represent the content of this file please contain it in a DIV

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 12/11/2019
    -->

    <head>
        <title>Movies: List</title>
        <link rel="stylesheet" type="text/css" href="MovieDatabasecss.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    </head>

    <body>
        <header>
            <?php
                require_once'functions/nav.php'; 
            ?>
        </header>

        <div class="container">
            <div class="content">
                <h1>Movie List:</h1>

                <?php 
                    require 'functions/Connection.php';

                    //Likes and dislikes from JS
                    $id = $_GET['Likeid'];
                    if($id) {
                        $sql = "UPDATE movies_tbl SET
                                likes = likes + 1
                                WHERE ID = ".$id.";";
                        mysqli_query($conn, $sql);
                    }
                    
                    $id = $_GET['Dislikeid'];
                    if($id) {
                        $sql = "UPDATE movies_tbl SET
                                likes = likes - 1
                                WHERE ID = ".$id.";";
                        mysqli_query($conn, $sql);                       
                    }

                    $sql = "SELECT * FROM movies_tbl";

                    //Make query and get result
                    $result = mysqli_query($conn, $sql);
                    if(!$result) {
                        echo"<p>No data in table</p>";
                        exit();
                    }
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
                    . "<th> &nbsp Search Count </th>"
                    . "<th> &nbsp Likes </th>"
                    . "<th> &nbsp Rate </th>";
                                        
                    //Display table data
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr><td class='id'> &nbsp" . $row['ID'] . "&nbsp </td>"
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
                        . "<td> &nbsp" . $row['searchNo'] . "</td>"
                        . "<td> &nbsp" . $row['likes'] . "</td>"
                        . "<td> <button type='button' class='addLike'><i class='fa fa-thumbs-up'></i>Like</button>
                            <button type='button' class='removeLike'><i class='fa fa-thumbs-down'></i>Dislike</button> </td></tr>";
                    }
                    
                    //Send Table to Browser
                    echo "</table>";
                    echo "";
                ?>

                <!-- Grab liked/disliked ID send to php -->
                <script>
                    $(".addLike").click(function() {
                        var $data = $(this).closest("tr");
                        var $id = parseInt($data.find(".id").text());
                        window.location.replace('MovieList.php?Likeid='+$id);
                    });
                    $(".removeLike").click(function() {
                        var $data = $(this).closest("tr");
                        var $id = parseInt($data.find(".id").text());
                        window.location.replace('MovieList.php?Dislikeid='+$id);
                    });
                </script>               
            </div>
        </div>
        
        <footer>
            <?php
                require_once'functions/footer.php'; 
            ?>      
        </footer>
    </body>
</html>