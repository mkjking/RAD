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
                    echo "<th> ID</th>" 
                    . "<th> Title</th>" 
                    . "<th> Studio</th>"
                    . "<th> Status</th>"
                    . "<th> Sound</th>"
                    . "<th> Versions</th>"
                    . "<th> RecRetPrice</th>"
                    . "<th> Rating</th>"
                    . "<th> Year</th>"
                    . "<th> Genre</th>"
                    . "<th> Aspect</th>"
                    . "<th> Search Count</th>"
                    . "<th> Likes</th>"
                    . "<th> Rate</th>";
                                        
                    //Display table data
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr><td class='id'>" . $row['ID'] . " </td>"
                        . "<td>" . $row['title'] . " </td>"
                        . "<td>" . $row['studio'] . " </td>" 
                        . "<td>" . $row['status'] . " </td>" 
                        . "<td>" . $row['sound'] . " </td>" 
                        . "<td>" . $row['versions'] . " </td>" 
                        . "<td>" . $row['recRetPrice'] . " </td>" 
                        . "<td>" . $row['rating'] . " </td>" 
                        . "<td>" . $row['year'] . " </td>"
                        . "<td>" . $row['genre'] . " </td>" 
                        . "<td>" . $row['aspect'] . " </td>"
                        . "<td>" . $row['searchNo'] . "</td>"
                        . "<td>" . $row['likes'] . "</td>"
                        . "<td> <button title='Like' type='button' class='addLike'><i class='fa fa-thumbs-up'></i>Like</button>
                            <button title='Dislike' type='button' class='removeLike'><i class='fa fa-thumbs-down'></i>Dislike</button> </td></tr>";
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