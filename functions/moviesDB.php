<!DOCTYPE html>

	<!-- 
        This php file is to handle DB selection to the SQL Database.
        To safely represent the content of this file please contain it in a DIV

        Author: Mitchel King
        Date: 16/11/2019
    -->

	<?php
		//Variables for connection
		//include 'Connection.php';

		//Make DB connection to movies
		if(!mysqli_query($conn, "USE $movieDatabase")) {
			echo"<p>Database not configured, press IMPORT</p>";
		}
	?>
</html>