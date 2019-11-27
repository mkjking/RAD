<!DOCTYPE html>

    <!-- 
        This php file is the ADMIN page of the website.
        This file is a page on its own and should be referenced as such.
        This admin page allows admins to remove people from the newsletter subscription

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 17/11/2019
    -->

    <head>
        <title>Movies: Admin</title>
        <link rel="stylesheet" type="text/css" href="MovieDatabasecss.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <header>
            <?php
                require_once'functions/nav.php'; 
            ?>
        </header>

        <div class="container">
            <div class="content">
                <h1>Admin Control</h1>

                <?php 
                    require 'functions/Connection.php';
                ?>
            </div>
            <div class="content">
                <?php 
                    require('functions/AdminLogin.php');
                    //CHECK FOR LOGIN
                    if($loginStatus) {
                        //PASSWORD AND REMOVE FORMS
                        echo' <form action="AdminControl.php" method="post">
                                  <label>Change Admin Password: </label><input type="text" name="adminPassword"><br>
                                  <input type="submit" name="btnChange" value="Change"/>
                              </form>
                              <form action="AdminControl.php" method="post">
                                   <label>User Email to Remove: </label><input type="text" name="userEmail"><br>
                                  <input type="submit" name="btnRemove" value="Remove"/>
                              </form>';

                        //USER TABLE
                        echo "<h1>SUBSCRIBED USERS</h1>";
                        require 'functions/Usertable.php';
                        echo "<h1>RATINGS HISTORY</h1>";

                        //Historical ratings
                     
                        include 'config.php';

                        $conn = mysqli_connect($host,$user,$password, $database);

                        $resultSet = $conn->query("SELECT ts FROM ratings_tbl ORDER BY ts DESC") 

                        ?>


                        <form action="ratingsHistory.php" method="post">
                            <select name="ratings">
                                <?php
                                    while($rows = $resultSet->fetch_assoc()){
                                    $ratingDate = $rows['ts'];
                                    echo "<option value='$ratingDate'>$ratingDate</option>";
                                    }
                                ?>
                            </select>
                            <p><input type="submit" name="btnGetGraph" value="Retreive Data"/></p>
                        </form>
                        <?php
                    }
                ?>
            </div>
        </div>
        
        <footer>
            <?php
                require 'functions/footer.php';
            ?>      
        </footer>
    </body>
</html>