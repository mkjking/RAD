<!DOCTYPE html>

    <!-- 
        This php file is to handle a CONNECTION to the SQL Database.
        To safely represent the content of this file please contain it in a DIV

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 12/11/2019
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
    //Variables for connection
    require 'config.php';

    $conn = mysqli_connect($host, $user, $password);
    //Report on connection Status
    if (!$conn) {
            echo "<p style=\"font-size: auto\">
                  Connection Status: <span style=\"color: Red\"> Offline</span></p>";
    } else {
            echo "<p style=\"font-size: auto\">
            Connection Status: <span style=\"color: #5AB9EA\"> Online</span></p>";

            $databaseconn = mysqli_query($conn, "USE $database");

            //Report on connection Status
        if (!$databaseconn) {
                echo "<p style=\"font-size: auto\">
                Database Status: <span style=\"color: Red\"> Offline</span></p>";
        } else {
                echo "<p style=\"font-size: auto\">
                Database Status: <span style=\"color: #5AB9EA\"> Online</span></p>";
        }
    }
    ?>
</html>