<!DOCTYPE html>
    <!-- 
        This php file is to handle a RESULT of the top 10 most searched Movies.
        To safely represent the content of this file please contain it in a DIV
        A connection to the database must be made prior to referencing this!

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 12/11/2019
    -->

    <h1>Top 10 Searched Movies</h1>

    <?php 
        
        //Get Movie Data
        $sql = "SELECT ID, title, searchNo  
                FROM movies_tbl
                ORDER BY searchNo DESC
                LIMIT 10";

        //Make query and get result
        $result = mysqli_query($conn, $sql);

        //Make sure result isnt false
        if($result === false) {
            echo "<p>No data in table</p>";
            exit();
        }

        //Check for results
        if(Mysqli_num_rows($result) != 0){
            
            //=====Build Graph=====
            //Image size
            $imageWidth = 1500;
            $imageHeight = 800;

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
            $barColour = imagecolorallocate($image, 0, 255, 0);

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

            while($row = mysqli_fetch_array($result)) {

                $value = $row['searchNo'];
                $key = $row['title'];

                //Draw the bar
                $x1 = $itemX - $barWidth / 2;
                $y1 = $gridBottom - (int)$row['searchNo'] / $yMaxValue * $gridHeight;
                $x2 = $itemX + $barWidth / 2;
                $y2 = $gridBottom;
                imagefilledrectangle($image, $x1, $y1, $x2, $y2, $barColour);

                //Draw the label
                $labelBox = imagettfbbox($fontSize, 0, $font, $row['title']);
                $labelWidth = $labelBox[4] - $labelBox[0];
                $labelX = ($divX - ($labelWidth / 1.3));
                $labelY = $gridBottom + $labelMargin + $fontSize + $labelWidth/1.3;
                imagettftext($image, $fontSize, 50, $labelX, $labelY, $labelColour, $font, $row['title']);
                $itemX += $barSpacing;

                //Draw the value
                imagettftext($image, $fontSize, 0, ($x1+$barWidth / 4), ($y1 - 5), $labelColour, $font, $row['searchNo']);

                //Draw divider              
                imageline($image, $divX, $gridBottom + 5, $divX, $gridBottom - 5 , $axisColour);
                $divX += $barSpacing;    
            }

            //Draw Axis
            imageline($image, $gridLeft, $gridTop, $gridLeft, $gridBottom, $axisColour);
            imageline($image, $gridLeft, $gridBottom, $gridRight, $gridBottom, $axisColour);

            //Post to browser
            imagepng($image, "Searches.png");
            imagedestroy($image);
            echo "<img src='Searches.png'><p></p>";
        }
        else {
            echo "<h1>No Movies Found</h1>";
        }
    ?>
<html>