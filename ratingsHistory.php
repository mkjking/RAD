<!DOCTYPE html>

	<!-- 
        This php file is to handle representing past rating data.
        To safely represent the content of this file please contain it in a DIV

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 27/11/2019
    -->

    <head>
        <title>Movies: Admin</title>
        <link rel="stylesheet" type="text/css" href="MovieDatabasecss.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    </head>

    <body>
        <header>
            <?php
                require_once'functions/nav.php'; 
            ?>
        </header>

        <div class="container">
            <div class="content">
                <h1>Admin Controls</h1>

                <?php 
                    require'functions/Connection.php';
                ?>
            </div>

            <div class="content">

<!----------------- Uncomment to bring back date selector, which logs admin out ---------------------->
                <?php
                    include 'config.php';
                    $conn = mysqli_connect($host,$user,$password, $database);
                    $resultSet = $conn->query("SELECT ts FROM ratings_tbl ORDER BY ts DESC");
                ?>

                <form action="ratingsHistory.php" method="post">
                    <select name="ratings">
                        <?php
                            while($rows = $resultSet->fetch_assoc()){
                            $ratingDate = $rows['ts'];
                            echo "<option value='$ratingDate'>$ratingDate</option>";
                            }
                        ?>
                    </select>
                    <p><input id="retrieve" class="retrieveBtn" type="submit" name="btnGetGraph" value="Retreive Data" /></p>
                    <input type="hidden" id="count" name="custId" value="1">
                </form>
<!------------------------------------------------------------------------------------------------------>
                <?php
                    //Perform a check for button click 
                    if (isset($_POST['btnGetGraph'])){

                        //Retreive date from input
                        $date = $_POST["ratings"];

                        //declare variable
                        $Ratings;

                        require 'functions/Rating.php';

                        //Get Movie Data
                        $sql = "SELECT * FROM ratings_tbl
                            WHERE ts = '$date'";

                        //Make query and get result
                        $result = mysqli_query($conn, $sql);

                        //Make sure result isnt false
                        if(!$result) {
                            echo "<p>No data in table</p>";
                            exit();
                        }

                        while($row = mysqli_fetch_array($result)) {
                            //get top 10 ID's
                            $first = new Rating();
                            $first = unserialize($row['first']);
            
                            $second = new Rating();
                            $second = unserialize($row['second']);
            
                            $third = new Rating();
                            $third = unserialize($row['third']);
            
                            $fourth = new Rating();
                            $fourth = unserialize($row['fourth']);
            
                            $fifth = new Rating();
                            $fifth = unserialize($row['fifth']);
            
                            $sixth = new Rating();
                            $sixth = unserialize($row['sixth']);
            
                            $seventh = new Rating();
                            $seventh = unserialize($row['seventh']);
            
                            $eighth = new Rating();
                            $eighth = unserialize($row['eighth']);
            
                            $ninth = new Rating();
                            $ninth = unserialize($row['ninth']);
            
                            $tenth = new Rating();
                            $tenth = unserialize($row['tenth']);

                            ///add all 10
                            $Ratings[] = $first;
                            $Ratings[] = $second;
                            $Ratings[] = $third;
                            $Ratings[] = $fourth;
                            $Ratings[] = $fifth;
                            $Ratings[] = $sixth;
                            $Ratings[] = $seventh;
                            $Ratings[] = $eighth;
                            $Ratings[] = $ninth;
                            $Ratings[] = $tenth;
                        }

                        //=============== Build Graph ===============
                            //Image size
                            $imageWidth = 1500;
                            $imageHeight = 900;

                            //Grid within image
                            $gridTop = 50;
                            $gridLeft = 230;
                            $gridBottom = 470;
                            $gridRight = 1370;
                            $gridHeight = $gridBottom - $gridTop;
                            $gridWidth = $gridRight - $gridLeft;

                            //Sizes of bars and lines
                            $lineWidth = 3;
                            $gridLineWidth = 1;
                            $barWidth = 25;

                            // Font settings
                            $font = realpath('fonts/Righteous-Regular.ttf');
                            $fontSize = 14;
                            
                            //Max value on y-axis
                            $yMaxValue = 50;

                            //Label margins
                            $labelMargin = 8;

                            // Distance between grid lines on y-axis
                            $yLabelSpan = $yMaxValue / 4;

                            //Initialise image
                            $image = imagecreate($imageWidth, $imageHeight);

                            //Setup colours
                            $backgroundColour = imagecolorallocate($image, 32, 32, 32);
                            $axisColour = imagecolorallocate($image, 255, 255, 255);
                            $labelColour = $axisColour;
                            $gridColour = imagecolorallocate($image, 125, 125, 125);
                            $barColour = imagecolorallocate($image, 0, 255, 255);

                            //Fill background
                            imagefill($image, 0, 0, $backgroundColour);

                            //Set line thickness for grid
                            imagesetthickness($image, $gridLineWidth);

                            //Draw and label grid
                            for($i = 0; $i <= $yMaxValue; $i += $yLabelSpan) {
                                $y = $gridBottom - $i * $gridHeight / $yMaxValue;

                                // draw the line
                                imageline($image, $gridLeft, $y, $gridRight, $y, $gridColour);

                                // draw right aligned label
                                $labelBox = imagettfbbox($fontSize, 0, $font, strval($i));
                                $labelWidth = $labelBox[4] - $labelBox[0];
                                $labelX = $gridLeft - $labelWidth - $labelMargin;
                                $labelY = $y + $fontSize / 2;
                                imagettftext($image, $fontSize, 0, $labelX, $labelY, $labelColour, $font, strval($i));
                            }

                            //set image line thickness for Axis
                            imagesetthickness($image, $lineWidth);

                            //Draw Bars

                            $barSpacing = $gridWidth / 10;
                            $itemX = $gridLeft + $barSpacing / 2;
                            $divX = $gridLeft + $barSpacing;

                            foreach ($Ratings as $value) {

                                $likes = $value->likes;
                                $title = $value->name;

                                //Draw the bar
                                $x1 = $itemX - $barWidth / 2;
                                $y1 = $gridBottom - (int)$likes / $yMaxValue * $gridHeight;
                                $x2 = $itemX + $barWidth / 2;
                                $y2 = $gridBottom;
                                imagefilledrectangle($image, $x1, $y1, $x2, $y2, $barColour);

                                //Draw the label
                                $labelBox = imagettfbbox($fontSize, 0, $font, $title);
                                $labelWidth = $labelBox[4] - $labelBox[0];
                                $labelX = ($divX - ($labelWidth / 1.3));
                                $labelY = $gridBottom + $labelMargin + $fontSize + $labelWidth/1.3;
                                imagettftext($image, $fontSize, 50, $labelX, $labelY, $labelColour, $font, $title);
                                $itemX += $barSpacing;

                                //Draw the value
                                imagettftext($image, $fontSize, 0, ($x1+$barWidth / 4), ($y1 - 5), $labelColour, $font, $likes);

                                //Draw divider              
                                imageline($image, $divX, $gridBottom + 5, $divX, $gridBottom - 5 , $axisColour);
                                $divX += $barSpacing;    
                            }

                            //Draw Axis
                            imageline($image, $gridLeft, $gridTop, $gridLeft, $gridBottom, $axisColour);
                            imageline($image, $gridLeft, $gridBottom, $gridRight, $gridBottom, $axisColour);

                            //Post to browser
                            imagepng($image, "RatingsHistorical.png");
                            imagedestroy($image);
                            echo "<h1>$date</h1>";
                            echo "<img src='RatingsHistorical.png'><p></p>";

                            //Uncomment this line and comment out javsscript if using date selector
                            echo "<p class='unsub'><a href='Admin.php'>Back to Admin Page</a></p>";
                            // echo'<button title="Back to Admin" type="button" class="goBack">Back to Admin</button>
                            //     <script>
                            //         $(".goBack").click(function(){
                            //              window.history.back();
                            //             });
                            //     </script>';
                   }   
                ?>
                
            </div>
        </div>

    </body>
</html>