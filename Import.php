<!DOCTYPE html>

    <!-- 
        This php file is to handle the IMPORT of a ".csv" file.
        This file is a page on its own and should be referenced as such

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
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
                        <p><input type="submit" name="btnImport" value="Import Movies" onclick="importDatabase()" /></p>
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
        function importDatabase() {
            <?php
                if (isset($_POST['btnImport'])){
                    
                    //===== Function for creating database =====//

                    //Variables for connection
		            include 'config.php';

		            //Make server connection
		            $conn = mysqli_connect($host,$user,$password);

                    //create database
                    $sql = "CREATE DATABASE IF NOT EXISTS $database";

                    //Attempt query
                    if (mysqli_query($conn, $sql)) {

                        //select database
                        $conn = mysqli_connect($host,$user,$password, $database);
                        
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
                            searchNo INTEGER(6),
                            likes INTEGER(10)
                            )";

                        //Run Query
                        if (mysqli_query($conn, $sql)) {
                                            
                            //Purge table in case it exists
                            $sql = "DELETE FROM movies_tbl";
                            if (mysqli_query($conn, $sql)) {
                                                
                                //Load movie data
                                $sql = "LOAD DATA LOCAL INFILE 'assets/Movies.csv'
                                    INTO TABLE movies_tbl
                                    FIELDS TERMINATED BY ','
                                    ENCLOSED BY '\"'
                                    LINES TERMINATED BY '\r\n'
                                    IGNORE 1 ROWS";

                                //Run query
                                if (mysqli_query($conn, $sql)) {
                                    //Populate search no column
                                    $sql = "UPDATE movies_tbl 
                                        SET searchNo = 0";
                                    if (mysqli_query($conn, $sql)) {
                                        echo "<p>Import Success</p>";
                                        header("Refresh:0");
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
                        $sql = "CREATE TABLE IF NOT EXISTS email_tbl (
                                email VARCHAR(40),
                                name VARCHAR(20),
                                news TINYINT(1),
                                blast TINYINT(1));";

                                //Create email_tbl
                                if(!mysqli_query($conn, $sql)) {
                                    echo "<p>Failed email Table Creation</p>";
                                }

                        $sql = "CREATE TABLE IF NOT EXISTS admin_tbl (
                                Email VARCHAR(50),
                                Password VARCHAR(50));";

                                if(!mysqli_query($conn, $sql)) {
                                    echo "<p>Failed admin Table Creation</p>";
                                }
                    } else {
                        echo "<p>Failed Database Creation</p>";
                    }
                }
            ?>
        }
    </script>
</html>