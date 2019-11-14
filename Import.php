<!DOCTYPE html>

    <!-- 
        This php file is to handle the IMPORT of a ".csv" file.
        This file is a page on its own and should be referenced as such

        Author: Blayde Dietsch
        Date: 12/11/2019
    -->

    <head>
        <title>Movies: Import</title>
        <link rel="stylesheet" type="text/css" href="MovieDatabasecss.css"/>
    </head>

    <body>
        <header>
            <?php
                //Include navigation Bar
                require_once'functions/nav.php';
            ?>
        </header>

        <div class="container">
            <div class="content">

                <h1>Import Menu:</h1>

                <?php 
                    //Report on validity of the database
                    require_once'functions/Connection.php';
                ?>

                <div class="work">

                    <form action="Import.php" method="post">
                        <p><input type="submit" name="btnImport" value="Import Movies" onclick="import()" /></p>
                    </form>
                    
                </div>
            </div>
        </div>
        
        <footer>
            <?php
                require_once'functions/footer.php'; 
            ?>      
        </footer>
    </body>

    <script>
        function import() {
            <?php
                if (isset($_POST['btnImport'])){
                    
                    //===== Function for creating database =====//

                    //Include variables
                    include 'config.php';
                    
                    //Create a connection 
                    $conn = mysqli_connect($host,$user,$password);
                    if (!$conn) {
                        echo "<p>Failed Initial connection to MySQLDatabase</p>";
                        exit();
                    }
                    //create databnase
                    $sql = "CREATE DATABASE IF NOT EXISTS rentalmovies_db";
                    //Attempt query
                    if (mysqli_query($conn, $sql) === true) {

                        //Make direct connection to database
                        $conn = mysqli_connect($host,$user,$password, $database, $port);
                        if (!$conn) {
                            echo "<p>Failed Secondary connection to MySQLDatabase</p>";
                            exit();
                        }

                        $sql = "CREATE TABLE IF NOT EXISTS movies_tbl (
                            ID INTEGER(4),
                            title VARCHAR(50),
                            studio VARCHAR(30),
                            status VARCHAR(30),
                            sound VARCHAR(30),
                            versions VARCHAR(30),
                            recRetPrice DECIMAL(3,2),
                            rating VARCHAR(5),
                            year VARCHAR(4),
                            genre VARCHAR(50),
                            aspect VARCHAR(6),
                            searchNo INTEGER(6)
                            )";
                        //Run Query
                        if (mysqli_query($conn, $sql) === TRUE) {
                                            
                            //Purge table in case it exists
                            $sql = "DELETE FROM movies_tbl";
                            if (mysqli_query($conn, $sql) === TRUE) {
                                                
                                //Load movie data
                                $sql = "LOAD DATA LOCAL INFILE 'assets/Movies.csv'
                                    INTO TABLE movies_tbl
                                    FIELDS TERMINATED BY ','
                                    ENCLOSED BY '\"'
                                    LINES TERMINATED BY '\r\n'
                                    IGNORE 1 ROWS";

                                //Run query
                                if (mysqli_query($conn, $sql) === true) {
                                    //Populate search no column
                                    $sql = "UPDATE movies_tbl 
                                        SET searchNo = 0";
                                    if (mysqli_query($conn, $sql) === true) {
                                        echo "<p>Import Success</p>";
                                    }else {
                                        echo "<p>Import Failure</p>";
                                    }
                                }else {
                                    echo "<p>Import Failure</p>";
                                }
                            } else {
                                echo "<p>Failed Table Purge</p>";
                            }
                        } else {
                            echo "<p>Failed Table Creation</p>";
                        }
                    } else {
                        echo "<p>Failed Database Creation</p>";
                    }
                }
            ?>
        }
    </script>
</html>