<!DOCTYPE html>

	<!-- 
        This php file is to handle a creation of a new user to the SQL Database.
        To safely represent the content of this file please contain it in a DIV

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 16/11/2019
    -->


    <form action="Signup.php" method="post">
        <p>Full Name: <input type="text" name="userName" placeholder="John Smith"></p>
        <p>Email: <input type="text" name="email" placeholder="JohnSmith@email.com"></p>
        <p>Receive Monthly Newsletter?: Yes Please<input type="radio" name="monthlyEmails" value="true" checked> No Thanks<input type="radio" name="monthlyEmails" value="false"></p>
        <p>Receive Movie Blasts?: Yes Please<input type="radio" name="newsEmails" value="true" checked> No Thanks<input type="radio" name="newsEmails" value="false"></p>
        <p><input type="submit" name="btnSignup" value="Sign Up!" /></p>
    </form>

	<?php
		//Perform a check for signup button click 
        if (isset($_POST['btnSignup'])){

            //Retreive all data from inputs
            $userName = $_POST["userName"];
            $email = $_POST["email"];
            $monthlyEmails = $_POST["monthlyEmails"];
            $newsEmails = $_POST["newsEmails"];
            $emailRegex = "/^[a-z1-9]+(.[a-z1-9]+)@[a-z](.[a-z1-9]+)*((.com.au)|(.com)|(.net))/";

            //Turn bool into 1 or 0 for DB
            if($newsEmails === 'true') {
                $newsEmails = 1;
            }
            else {
                $newsEmails = 0;
            }
            if($monthlyEmails === 'true') {
                $monthlyEmails = 1;
            }
            else {
                $monthlyEmails = 0;
            }

            //Check for validation
            if ($monthlyEmails == 0 && $newsEmails == 0) {
                echo "<p class='note'>YOU MUST ACCEPT AT LEAST ONE SUBSCRIPTION TO SIGN UP</p>";
            } else {
                if(preg_match($emailRegex, $email)) {
                    $sql = "SELECT * 
                        FROM email_tbl
                        WHERE email = '$email';";
                    //Check email
                    $rowResult = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($rowResult)<=0) {
                        $sql = "INSERT INTO email_tbl
                            (email, name,
                            news, blast)
                            VALUES('$email',
                            '$userName', '$monthlyEmails',
                            '$newsEmails'
                            );";

                        if(!mysqli_query($conn, $sql)) {
                            echo "<h1>Insert statement error</h1>";
                            exit();
                        }
                        echo "<h1>Account created succesfully</h1>";
                    }
                    else {
                        echo "<h1>Email already exists</h1>";
                    }
                }
                else {
                    echo "<h1>Invalid Email</h1>";
                }
            }

        }
	?>
</html>