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

                    <form action="Setup.php" method="post">
                        <h1>Setup Database:</h1>
                        <p><input title="Setup Database" type="submit" name="btnSetupDatabase" value="Setup Database" onclick="SetupDatabase()" /></p>
                        <h1>Import Data:</h1>
                        <p>
                            <input title="Import Movies SQL" type="submit" name="btnImportSQL" value="Import Movies SQL" onclick="ImportSQL()" />
                            <input title="Import Movies CSV" type="submit" name="btnImportCSV" value="Import Movies CSV" onclick="ImportCSV()" />
                        </p>
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
        function SetupDatabase() {
            <?php
                if (isset($_POST['btnSetupDatabase'])){
                    
                    //=============== Function for creating database ===============//

                    //Variables for connection
		            include 'config.php';

		            //Make server connection
                    $conn = mysqli_connect($host,$user,$password);
                    
                    //=============== DATABASE CREATION ===============//

                    //create and use database
                    $sql = "CREATE DATABASE IF NOT EXISTS $database";

                    //Attempt query
                    mysqli_query($conn, $sql) or die("Failed Database Creation");

                    //select database
                    $conn = mysqli_connect($host,$user,$password, $database);

                    //=============== MOVIE TABLE CREATION ===============//

                    //SQL for creation of movies Table 
                    $sql ="CREATE TABLE IF NOT EXISTS `movies_tbl` (
                            `ID` int(4) DEFAULT NULL,
                            `title` varchar(50) DEFAULT NULL,
                            `studio` varchar(30) DEFAULT NULL,
                            `status` varchar(30) DEFAULT NULL,
                            `sound` varchar(30) DEFAULT NULL,
                            `versions` varchar(30) DEFAULT NULL,
                            `recRetPrice` decimal(3,2) DEFAULT NULL,
                            `rating` varchar(5) DEFAULT NULL,
                            `year` varchar(4) DEFAULT NULL,
                            `genre` varchar(50) DEFAULT NULL,
                            `aspect` varchar(6) DEFAULT NULL,
                            `searchNo` int(6) DEFAULT 0,
                            `likes` INTEGER(10) DEFAULT 0
                        )";

                    //Attempt query
                    mysqli_query($conn, $sql) or die("Failed Movie Table Creation");
                    
                    //Purge table in case it exists
                    $sql = "DELETE FROM movies_tbl";

                    mysqli_query($conn, $sql) or die("Failed Movie Table Purge");

                    //=============== ADMIN TABLE CREATION + DUMP ===============//
                    
                    //CREATE

                    //SQL for table Creation
                    $sql = "CREATE TABLE IF NOT EXISTS `admin_tbl` (
                        `Email` varchar(255) NOT NULL,
                        `Password` varchar(255) NOT NULL
                      )";

                    //Attempt query
                    mysqli_query($conn, $sql) or die("Failed Admin Table Creation");
                    
                    //PURGE

                    //Purge table in case it exists
                    $sql = "DELETE FROM admin_tbl";
                    //Attempt query
                    mysqli_query($conn, $sql) or die("Failed Admin Table Purge");

                    //INSERT

                    //Insert default Data
                    $sql = "INSERT INTO `admin_tbl` (`Email`, `Password`) VALUES
                    ('acmetestsmtafe@gmail.com', 'password1')";
                    //Attempt query
                    mysqli_query($conn, $sql) or die("Failed Admin Table Insert");

                    //=============== EMAIL TABLE CREATION ===============//
                    
                    //CREATE

                    //SQL for table Creation
                    $sql = "CREATE TABLE IF NOT EXISTS `email_tbl` (
                        `email` varchar(40) DEFAULT NULL,
                        `name` varchar(20) DEFAULT NULL,
                        `news` tinyint(1) DEFAULT NULL,
                        `blast` tinyint(1) DEFAULT NULL
                      )";

                    //Attempt query
                    mysqli_query($conn, $sql) or die("Failed Email Table Creation");
                    
                    //PURGE

                    //Purge table in case it exists
                    $sql = "DELETE FROM email_tbl";
                    //Attempt query
                    mysqli_query($conn, $sql) or die("Failed Email Table Purge");
                    
                    //=============== RATINGS TABLE CREATION ===============//
                    
                    //CREATE

                    //SQL for table Creation
                    $sql = "CREATE TABLE `ratings_tbl` (
                        `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        `first` tinytext,
                        `second` tinytext,
                        `third` tinytext,
                        `fourth` tinytext,
                        `fifth` tinytext,
                        `sixth` tinytext,
                        `seventh` tinytext,
                        `eighth` tinytext,
                        `ninth` tinytext,
                        `tenth` tinytext
                      )";

                    //Attempt query
                    mysqli_query($conn, $sql) or die("Failed Ratings Table Creation");
                    
                    //PURGE

                    //Purge table in case it exists
                    $sql = "DELETE FROM ratings_tbl";
                    //Attempt query
                    mysqli_query($conn, $sql) or die("Failed ratings Table Purge");

                    //REFRESH BROWSER
                    header("Refresh:0");
                }
            ?>
        }

        function ImportCSV() {
            <?php
                if (isset($_POST['btnImportCSV'])){
                    //=============== Function for importing with CSV to database ===============//

                    //Variables for connection
		            include 'config.php';

		            //Make server connection
                    $conn = mysqli_connect($host,$user,$password,$database);

                    //Load movie data CSV
                    $sql = "LOAD DATA LOCAL INFILE 'assets/Movies.csv'
                    INTO TABLE movies_tbl
                    FIELDS TERMINATED BY ','
                    ENCLOSED BY '\"'
                    LINES TERMINATED BY '\r\n'
                    IGNORE 1 ROWS";

                    //Attempt query
                    mysqli_query($conn, $sql) or die("Failed to Load Data");

                    echo "<p>Import Success</p>";
                }
            ?>
        }

        function ImportSQL() {
            <?php
                if (isset($_POST['btnImportSQL'])){
                    //=============== Function for importing with SQL to database ===============//

                    //Variables for connection
		            include 'config.php';

		            //Make server connection
                    $conn = mysqli_connect($host,$user,$password,$database);

                    $filename = "assets/movies.sql";

                    // Temporary variable, used to store current query
                    $templine = '';

                    // Read in entire file
                    $lines = file($filename);

                    // Loop through each line
                    foreach ($lines as $line) {
                    // Skip it if it's a comment
                        if (substr($line, 0, 2) == '--' || $line == '')
                            continue;

                    // Add this line to the current segment
                        $templine .= $line;
                    // If it has a semicolon at the end, it's the end of the query
                        if (substr(trim($line), -1, 1) == ';') {
                            // Perform the query
                            mysqli_query($conn, $templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $conn->error() . '<br /><br />');
                            // Reset temp variable to empty
                            $templine = '';
                        }
                    }

                    echo "<p>Import Success</p>";
                }
            ?>
        }
    </script>
</html>