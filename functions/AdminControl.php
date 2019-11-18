<!DOCTYPE html>

	<!-- 
        This php file is to handle management of subscribed users.
        To safely represent the content of this file please contain it in a DIV

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 16/11/2019
    -->
    <form action="Admin.php" method="post">
        <label>Admin Password: </label><input type="text" name="adminPassword" placeholder=""><br>
        <input type="submit" name="btnChange" value="Change"/>
    </form>
    <form action="Admin.php" method="post">
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
            mysqli_query($conn, $sql);



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
</html>