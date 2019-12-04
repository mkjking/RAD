<!DOCTYPE html>

    <!-- 
        This php file is to handle management of subscribed users.
        To safely represent the content of this file please contain it in a DIV

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 16/11/2019
    -->


    <?php
        /**
        PHP version 7

        @category SQL

        @package RAD

        @author Original Author <mitchel_king@icloud.com>

        @license http://www.php.net/license PHP license 7

        @link http:/pear.php.net
         **/

        //Perform a check for button click 
    if (isset($_POST['btnLogin'])) {

        //Retreive password from input
        $passwordEntered = $_POST["password"];
        $emailEntered = $_POST["adminEmail"];

        $sql = "SELECT *
                FROM admin_tbl";

        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            $adminPassword = $row['Password'];
            $adminEmail = $row['Email'];
        }
            
        if ($passwordEntered === $adminPassword 
            && $adminEmail === $emailEntered
        ) {
            $loginStatus=true;
            session_start();
            $_SESSION["user"] = $emailEntered;
            $_SESSION["pass"] = $passwordEntered;
        } else {
            $loginStatus = false;
            echo "<p style=\"font-size: 20px\"><span style=\"
            color: Red\"> Details Incorrect</span></p>";
        }
    }
    ?>
</html>