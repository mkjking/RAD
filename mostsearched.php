<html>
    <head>
        <style>
            <?php require 'search.css';?>
        </style>
    </head>
    <body>
        <?php
        //Code to handle most Searched
        include $_SERVER['DOCUMENT_ROOT'].'/WEB/header/header.php';

        echo "<br>";
        $array = array();
        $initialTitleArray = array();

        //Server variables
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $database   = "project_movies";

        //Connection
        $connection = mysqli_connect($servername, $username, $password, $database);
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        //Array of most searched query
        $sqlArrayValues = "SELECT * FROM project_movies
                            ORDER BY SearchCount DESC LIMIT 10";
        $result = mysqli_query($connection, $sqlArrayValues);

        //fills initial arrays from the database
        while($row = mysqli_fetch_array($result)) {
            $array[] = $row['SearchCount'];
            $initialTitleArray[] = $row['Title'];
        }

        //fills final array from intial arrays shifted over one for easier picture creation
        for($i = 1; $i <= 10; $i++)
        {
            $secondArray[$i] = $array[$i - 1];
            $titleArray[$i] = $initialTitleArray[$i - 1];
        }

        //not sure why this is here
        while($row = mysqli_fetch_array($result)) {
            $array[] = $row['SearchCount'];
        }

        //initial values for picture
        $numcolumns = count($secondArray);
        $height = 500;
        $width = 500;
        $padding = 5;

        //picture creation
        $columnWidth = $width / $numcolumns;
        $maxValue = max($secondArray);
        $image = imagecreate($width, $height);
        $white = imagecolorallocate($image, 0xff, 0xff, 0xff);
        $lightGrey = imagecolorallocate($image, 0xee, 0xee, 0xee);
        $darkGrey = imagecolorallocate($image, 0x7f, 0x7f, 0x7f);
        imagefilledrectangle($image, 0,0, $width, $height, $white);

        //colours for the graph and key table
        $blue = imagecolorallocate($image, 0, 0, 255);
        $red = imagecolorallocate($image, 255, 0, 0);
        $green = imagecolorallocate($image, 0, 255, 0);
        $purple = imagecolorallocate($image, 148, 0, 211);
        $orange = imagecolorallocate($image, 255, 145, 0);
        $yellow = imagecolorallocate($image, 255, 255, 0);
        $brown = imagecolorallocate($image, 139, 69, 19);
        $pink = imagecolorallocate($image, 255, 192, 203);
        $lightgrey = imagecolorallocate($image, 170, 170, 170);
        $darkgrey = imagecolorallocate($image, 25, 25, 25);
        $colorArray = array();
        $colorArray[1] = $red;
        $colorArray[2] = $blue;
        $colorArray[3] = $orange;
        $colorArray[4] = $darkgrey;
        $colorArray[5] = $pink;
        $colorArray[6] = $green;
        $colorArray[7] = $brown;
        $colorArray[8] = $yellow;
        $colorArray[9] = $purple;
        $colorArray[10] = $lightgrey;

        //graph filling
        for($i = 1; $i <= $numcolumns; $i++)
        {
            $columnHeight = ($height / 100) * (($secondArray[$i] / $maxValue) * 100);
            $x1 = ($i * $columnWidth) - $columnWidth;
            $y1 = $height - $columnHeight;
            $x2 = (($i + 1) * $columnWidth) - $padding - $columnWidth;
            $y2 = $height;
            imagefilledrectangle($image, $x1, $y1, $x2, $y2, $colorArray[$i]);
            imageline($image, $x1, $y1, $x1, $y2, $lightGrey);
            imageline($image, $x1, $y2, $x2, $y2, $lightGrey);
            imageline($image, $x2, $y1, $x2, $y2, $darkGrey);
        }

        imagepng($image, "image.png");

        //initial creation of number image
        $numberImageHeight = 50;
        $numberImage = imagecreate($width, $numberImageHeight);
        $backgroundColor = imagecolorallocate($numberImage, 255, 255, 255);
        $textColor = imagecolorallocate($numberImage, 0, 0, 0);

        //numbers for graph
        for($i = 1; $i <= $numcolumns; $i++)
        {
            $x = ($i * $columnWidth) - $columnWidth;
            imagestring($numberImage, 5, $x + 15, 1, $secondArray[$i], $textColor);
        }
        imagepng($numberImage, "numbers.png");
        ?>
        <img src='image.png'>
        <br>
        <img src='numbers.png'>
        <br>
        <?php
        //key table creation
        echo "<table>
            <tr><th>COLOR</th><th>TITLE</th></tr>
            <tr><td style='background-color: red'></td><td>$titleArray[1]</td></tr>
            <tr><td style='background-color: blue'></td><td>$titleArray[2]</td></tr>
            <tr><td style='background-color: orange'></td><td>$titleArray[3]</td></tr>
            <tr><td style='background-color: black'></td><td>$titleArray[4]</td></tr>
            <tr><td style='background-color: pink'></td><td>$titleArray[5]</td></tr>
            <tr><td style='background-color: limegreen'></td><td>$titleArray[6]</td></tr>
            <tr><td style='background-color: saddlebrown'></td><td>$titleArray[7]</td></tr>
            <tr><td style='background-color: yellow'></td><td>$titleArray[8]</td></tr>
            <tr><td style='background-color: purple'></td><td>$titleArray[9]</td></tr>
            <tr><td style='background-color: darkgray'></td><td>$titleArray[10]</td></tr>
        </table>"
        ?>
    </body>
</html>
