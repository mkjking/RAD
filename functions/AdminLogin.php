<!DOCTYPE html>

	<!-- 
        This php file is to handle management of subscribed users.
        To safely represent the content of this file please contain it in a DIV

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 16/11/2019
    -->


    <form action="Admin.php" method="post">
        <p>Password: <input type="text" name="password" placeholder=""></p>
        <p><input type="submit" name="btnLogin" value="Login" /></p>
    </form>

	<?php
		//Perform a check for button click 
        if (isset($_POST['btnLogin'])){

            //Retreive password from input
            $passwordEntered = $_POST["password"];

            include "config.php";
            
            if ($passwordEntered === $adminPassword){
                require "functions/AdminControl.php";
            }else{
                echo "<p style=\"font-size: auto\"><span style=\"color: Red\"> Password Incorrect</span></p>";
            }
        }
	?>
</html>