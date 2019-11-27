<!DOCTYPE html>

	<!-- 
        This php file is to handle management of subscribed users.
        To safely represent the content of this file please contain it in a DIV

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 16/11/2019
    -->


    <form action="Admin.php" method="post">
        <label>Email: </label><input type="text" name="adminEmail" placeholder=""><br>
        <label>Password: </label><input type="text" name="password" placeholder=""><br>
        <input type="submit" name="btnLogin" value="Login" />
    </form>

	<?php

        $loginStatus = false;

		//Perform a check for button click 
        if (isset($_POST['btnLogin'])){

            //Retreive password from input
            $passwordEntered = $_POST["password"];
            $emailEntered = $_POST["adminEmail"];

            $sql = "SELECT *
                    FROM admin_tbl";

            $result = mysqli_query($conn, $sql);

            if ($row = mysqli_fetch_assoc($result))
            {
                $adminPassword = $row['Password'];
                $adminEmail = $row['Email'];
            }
            
            if ($passwordEntered === $adminPassword && $adminEmail === $emailEntered){
                $loginStatus=true;
            }else{
                echo "<p style=\"font-size: 20px\"><span style=\"color: Red\"> Details Incorrect</span></p>";
            }
        }
	?>
</html>