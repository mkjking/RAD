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
                    if (isset($_POST['btnChange'])){
                        $newPassword = $_POST['adminPassword'];

                        $sql = "UPDATE admin_tbl
                                SET `Password`='$newPassword'
                                WHERE Email='acmetestsmtafe@gmail.com'";

                        if (mysqli_query($conn, $sql)){
                            echo "<p><span style=\"color: Lime\"> Password Changed!</span></p>";
                        }else{
                            echo "<p><span style=\"color: Red\"> Failed to change password!</span></p>";
                        }
                        echo "<p class='unsub'><a href='Admin.php'>Back to Admin Page</a></p>";
                    }

                    //REMOVE USER
                    if (isset($_POST['btnRemove'])){

                        //Retreive user email from input
                        $email = $_POST["userEmail"];

                        $sql = "SELECT * FROM email_tbl
                                WHERE email = '$email'";

                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result)<=0) {
                            echo "<p><span style=\"color: Red\"> Email Doesnt Exist!</span></p>";
                        }
                        else {
                            $sql = "DELETE FROM email_tbl
                                    WHERE email = '$email'";
                            mysqli_query($conn, $sql);
                            echo "<p><span style=\"color: Lime\"> Email Removed!</span></p>";
                        }
                        echo "<p class='unsub'><a href='Admin.php'>Back to Admin Page</a></p>";
                    }
                ?>
            </div>
        </div>

    </body>
</html>