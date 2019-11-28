<!DOCTYPE html>

    <!-- 
        This php file is to handle management of subscribed users.
        To safely represent the content of this file please contain it in a DIV

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 16/11/2019
    -->

    <head>
        <title>Movies: Admin</title>
        <link rel="stylesheet" type="text/css" href="MovieDatabasecss.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <header>
            <?php
            /**
            PHP version 7

            @category SQL

            @package RAD

            @author Original Author <mitchel_king@icloud.com>

            @license http://www.php.net/license PHP license 7

            @link http:/pear.php.net
             **/
            /** 
            Nav file
            
            @file nav.php

            renders the navigation bar
             **/
                require_once'functions/nav.php'; 
            ?>
        </header>

        <div class="container">
            <div class="content">
                <h1>Admin Controls</h1>
                <?php 
                    require'functions/Connection.php';
                ?>
            </div>
            <div class="content">
                <?php
                    //CHANGE EMAIL/PASSWORD
                if (isset($_POST['btnChange'])) {
                        $newPassword = $_POST['adminPassword'];
                        $checkEmail = $_POST['adminEmail'];

                        $sql = "UPDATE admin_tbl
                                SET `Password`='$newPassword'
                                WHERE Email='$checkEmail'";

                    if (mysqli_query($conn, $sql)) {
                            echo "<p><span style=\"color: Lime\">
                             Password Changed!</span></p>";
                    } else {
                            echo "<p><span style=\"color: Red\">
                             Failed to change password!</span></p>";
                    }
                        echo "<p class='unsub'><a href='Admin.php'>
                        Back to Admin Page</a></p>";
                }

                if (isset($_POST['btnCreate'])) {
                        $createEmail = $_POST['createEmail'];
                        $createPassword = $_POST['createPassword'];

                        //Password Regex
                    $passwordComplexity
                        = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/";

                    if (preg_match($passwordComplexity, $createPassword)) {
                            $sql = "SELECT * 
                            FROM admin_tbl
                            WHERE Email = '$createEmail';";

                            $rowResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($rowResult)<=0) {
                                $sql = "INSERT INTO admin_tbl
                                (Email, Password)
                                VALUES('$createEmail', '$createPassword');";

                            if (!mysqli_query($conn, $sql)) {
                                    echo "<h1>Insert statement error</h1>";
                                    exit();
                            }
                                echo "<h1>Account created succesfully</h1>";
                        } else {
                                echo "<h1>Account already exists</h1>";
                        }
                    } else {
                            echo "<h1>Invalid Password</h1>";
                    }
                }

                    //REMOVE USER
                if (isset($_POST['btnRemove'])) {

                    //Retreive user email from input
                    $email = $_POST["userEmail"];

                        $sql = "SELECT * FROM email_tbl
                                WHERE email = '$email'";

                        $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result)<=0) {
                            echo "<p><span style=\"color: Red\">
                             Email Doesnt Exist!</span></p>";
                    } else {
                            $sql = "DELETE FROM email_tbl
                                    WHERE email = '$email'";
                            mysqli_query($conn, $sql);
                        echo "<p><span style=\"color: Lime\">
                         Email Removed!</span></p>";
                    }
                    echo "<p class='unsub'><a href='Admin.php'>
                    Back to Admin Page</a></p>";
                }
                ?>
            </div>
        </div>

    </body>
</html>