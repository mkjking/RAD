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


                <form action="AdminControl.php" method="post">
                    <label>Change Admin Password: </label><input type="text" name="adminPassword" placeholder=""><br>
                    <input type="submit" name="btnChange" value="Change"/>
                </form>
                <form action="AdminControl.php" method="post">
                    <label>User Email to Remove: </label><input type="text" name="userEmail" placeholder=""><br>
                    <input type="submit" name="btnRemove" value="Remove"/>
                </form>

                <?php
                    //CHANGE EMAIL/PASSWORD
                    if (isset($_POST['btnChange'])){
                        $newPassword = $_POST['adminPassword'];

                        $sql = "UPDATE admin_tbl
                                SET `Password`='$newPassword'
                                WHERE Email='acmetestsmtafe@gmail.com'";

                        if (mysqli_query($conn, $sql)){
                            echo "<p style=\"font-size: auto\"><span style=\"color: Lime\"> Password Changed!</span></p>";
                        }else{
                            echo "<p style=\"font-size: auto\"><span style=\"color: Red\"> Failed to change password!</span></p>";
                        }
                    }

                    //REMOVE USER
                    if (isset($_POST['btnRemove'])){

                        //Retreive user email from input
                        $email = $_POST["userEmail"];

                        $sql = "DELETE FROM email_tbl
                                WHERE Email = '$email'";

                        //TODO: Execute the query
                    }
                ?>
            </div>
        </div>
        
        <footer>
            <?php
                require_once'functions/footer.php'; 
            ?>      
        </footer>
    </body>
</html>