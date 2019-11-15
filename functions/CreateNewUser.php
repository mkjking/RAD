<!DOCTYPE html>

	<!-- 
        This php file is to handle a creation of a new user to the SQL Database.
        To safely represent the content of this file please contain it in a DIV

        Author: Blayde Dietsch
        Date: 16/11/2019
    -->


    <form action="Signup.php" method="post">
        <p>Full Name: <input type="text" name="userName" placeholder="John Smith"></p>
        <p>Email: <input type="text" name="email" placeholder="JohnSmith@email.com"></p>
        <p>Receive monthly emails?: Yes Please<input type="radio" name="monthlyEmails" value="true" checked> No Thanks<input type="radio" name="monthlyEmails" value="false"></p>
        <p>Receive News Blast emails?: Yes Please<input type="radio" name="newsEmails" value="true" checked> No Thanks<input type="radio" name="newsEmails" value="false"></p>
        <p><input type="submit" name="btnSignup" value="Sign Up!" /></p>
    </form>

	<?php
		//Perform a check for signup button click 
        if (isset($_POST['btnSignup'])){

            //Retreive all data from inputs
            $userName = $_POST["userName"];
            $email = $_POST["email"];
            $monthlyEmails = (bool)$_POST["monthlyEmails"];
            $newsEmails = (bool)$_POST["newsEmails"];

            //Check for validation
            if(true) {//Condition to be added
                //To be coded
            }
            else {
                echo "<h1>Invalid</h1>";
            }
        }
	?>
</html>