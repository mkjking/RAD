<!DOCTYPE html>

	<!-- 
        This php file is to handle a CONNECTION to the SQL Database.
        To safely represent the content of this file please contain it in a DIV

        Author: Blayde Dietsch
        Date: 12/11/2019
    -->

	<?php
		
		//Variables for connection
		include 'config.php';

		//Make connection
		$conn = mysqli_connect($host,$user,$password, $database, $port);

		//Report on connection Status
		if (!$conn) {
			echo "<p style=\"font-size: auto\">Connection Status: <span style=\"color: Red\"> Offline</span></p>";
		}else {
			echo "<p style=\"font-size: auto\">Connection Status: <span style=\"color: Lime\"> Online</span></p>";
		}
	?>
</html>