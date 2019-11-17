<!DOCTYPE html>

	<!-- 
        This php file is to handle management of subscribed users.
        To safely represent the content of this file please contain it in a DIV

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 16/11/2019
    -->


    <form action="Admin.php" method="post">
        <p>User Email to Remove <input type="text" name="email" placeholder=""></p>
        <p><input type="submit" name="btnRemove" value="Remove" /></p>
    </form>

	<?php
		//Perform a check for button click 
        if (isset($_POST['btnSignup'])){

            //Retreive password from input
            $email = $_POST["email"];

            //CODE TO REMOVE ACCOUNT FROM DATABASE
        }
	?>
</html>