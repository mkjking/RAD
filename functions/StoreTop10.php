<!DOCTYPE html>
	<!-- 
        This file handles checking for and updating
        top10 ratings table. If table is updated a new image
        is generated and dispalyed at the front end
		
        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 26/11/2019
    -->

	<?php
		require 'Rating.php';
		//Get Movie Data
	    $sql = "SELECT ID, title, likes  
	                FROM movies_tbl
	                ORDER BY likes DESC
	                LIMIT 10";

	    //Make query and get result
	    $result = mysqli_query($conn, $sql);

	    //Make sure result isnt false
	    if(!$result) {
	        echo "<p>No data in table</p>";
	        exit();
	    }

	    //Get current top 10 rated
	    $serRatings = array();
	    $Ratings = array();
	    while($row = mysqli_fetch_array($result)) {
	    		//Set new object
	            $ratingObj = new Rating();
	            $ratingObj->setId($row['ID']);
	            $ratingObj->setLikes($row['likes']);
	            $ratingObj->setName($row['title']);

	            //Unserialized to array
	            $Ratings[] = $ratingObj;
	            //Serialize and escape new string
	            $serialized = serialize($ratingObj);
	            $serialized = mysqli_real_escape_string($conn, $serialized);
	            $serRatings[] = $serialized;
	        }

	    //Get recent most data from ratings_tbl to compare
	    $sql = "SELECT * FROM ratings_tbl
	    		ORDER BY ts DESC LIMIT 1";

	   	if(!$result = mysqli_query($conn, $sql)){
	        echo "<p>No data in table</p>";
	   	}

	   	$prevRatings = array();
	   	while($row = mysqli_fetch_array($result)) {
	   		//get top 10 ID's
	   		$first = new Rating();
	   		$first = unserialize($row['first']);
	   		$first = $first->id;

	   		$second = new Rating();
	   		$second = unserialize($row['second']);
	   		$second = $second->id;

	   		$third = new Rating();
	   		$third = unserialize($row['third']);
	   		$third = $third->id;

	   		$fourth = new Rating();
	   		$fourth = unserialize($row['fourth']);
	   		$fourth = $fourth->id;

	   		$fifth = new Rating();
	   		$fifth = unserialize($row['fifth']);
	   		$fifth = $fifth->id;

	   		$sixth = new Rating();
	   		$sixth = unserialize($row['sixth']);
	   		$sixth = $sixth->id;

	   		$seventh = new Rating();
	   		$seventh = unserialize($row['seventh']);
	   		$seventh = $seventh->id;

	   		$eighth = new Rating();
	   		$eighth = unserialize($row['eighth']);
	   		$eighth = $eighth->id;

	   		$ninth = new Rating();
	   		$ninth = unserialize($row['ninth']);
	   		$ninth = $ninth->id;

	   		$tenth = new Rating();
	   		$tenth = unserialize($row['tenth']);
	   		$tenth = $tenth->id;   		   		   		   		   		   		   		   		   		
	   		///add all 10
	   		$prevRatings[] = $first;
	   		$prevRatings[] = $second;
	   		$prevRatings[] = $third;
	   		$prevRatings[] = $fourth;
	   		$prevRatings[] = $fifth;
	   		$prevRatings[] = $sixth;
	   		$prevRatings[] = $seventh;
	   		$prevRatings[] = $eighth;
	   		$prevRatings[] = $ninth;
	   		$prevRatings[] = $tenth;
	   	}

	   	//compare and create new graph if needed
	   	if($Ratings[0]->id == $prevRatings[0] && $Ratings[1]->id == $prevRatings[1] &&
	   		$Ratings[2]->id == $prevRatings[2] && $Ratings[3]->id == $prevRatings[3] &&
	   		$Ratings[4]->id == $prevRatings[4] && $Ratings[5]->id == $prevRatings[5] &&
	   		$Ratings[6]->id ==$prevRatings[6] && $Ratings[7]->id == $prevRatings[7] &&
	   		$Ratings[8]->id == $prevRatings[8] && $Ratings[9]->id == $prevRatings[9]) {


	   		// echo previous image as top 10 hasnt changed, image only generated if data changes
	        //echo "<h1>Top 10 Rated Movies</h1>";
            //echo "<img src='Ratings.png'><p></p>";
	   	}
	   	else {
		    //send new top 10 rated to sql
		    $ser = serialize($serRatings);
		    $sql = "INSERT INTO ratings_tbl
		    		(first, second, third,
		    		fourth, fifth, sixth,
		    		seventh, eighth, ninth, tenth)
		    		VALUES (\"$serRatings[0]\", \"$serRatings[1]\",
		    		\"$serRatings[2]\", \"$serRatings[3]\",
		    		\"$serRatings[4]\", \"$serRatings[5]\",
		    		\"$serRatings[6]\", \"$serRatings[7]\",
		    		\"$serRatings[8]\", \"$serRatings[9]\");";
		    mysqli_query($conn, $sql) or die ('error' . mysqli_error($conn));
	
	   	}
	?>
<html>