<!DOCTYPE html>
    
    <!-- 
        This php file renders a table of all users in the database table.

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 12/11/2019
    -->

    <div class="content">
        <?php
            $sql = "SELECT * FROM email_tbl;";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0) {
                echo "<table border = '1' align = 'center'>";
                echo "<th> &nbsp Name &nbsp</th>" 
                . "<th> &nbsp Email &nbsp</th>"
                . "<th>&nbsp Monthly</th>"
                . "<th>&nbsp Blasts</th>";

                //Display table data
                while ($row = mysqli_fetch_array($result)) {
                    $monthly = (int)$row['news'];
                    $blast = (int)$row['blast'];

                    if($monthly == 0) {
                        $monthly = 'No';
                    }
                    else
                        $monthly = 'Yes';

                    if($blast == 0) {
                        $blast = 'No';
                    }
                    else
                        $blast = 'Yes';

                    echo "<tr><td> &nbsp" . $row['name'] . "&nbsp </td>"
                    . "<td> &nbsp" . $row['email'] . "&nbsp </td>"
                    . "<td> &nbsp" . $monthly . "&nbsp </td>"
                    . "<td> &nbsp" . $blast . "&nbsp </td>";
                }
                echo "</table>";
            }
            else
                echo'<h1>No Users currently signed up<h1>';
        ?>
    </div>
</html>