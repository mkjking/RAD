<html>
<head>
    <style>
        <?php require 'search.css';
        ?>
    </style>
</head>
<body>
<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/WEB/header/header.php';
?>
<h2>SEARCH MOVIES</h2>
<div class="form">
    <form method="post" action="#">
        Title:
        <input type="text" name="title">
        Genre:
        <input type="text" name="genre">
        Year:
        <input type="text" name="year">
        Rating:
        <select name="rating">
            <option value="">Not Specified</option>
            <option value="G">G</option>
            <option value="PG">PG</option>
            <option value="PG-13">PG-13</option>
            <option value="R">R</option>
            <option value="NC-17">NC-17</option>
            <option value="NR">NR</option>
            <option value="UR">UR</option>
            <option value="UNK">UNK</option>
            <option value="VAR">VAR</option>
        </select>
        <input type="submit" name="submit" value="Search">
    </form>
    <form method="post" action="mostsearched.php">
        <input type="submit" name="searched" value="Most Searched">
    </form>
</div>
    <?php
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

    //Search button pressed
    if (isset($_POST['submit'])) {
        //Search Variables
        $title  = $_POST['title'];
        $genre  = $_POST['genre'];
        $year   = $_POST['year'];
        $rating = $_POST['rating'];

        //Search count increases search count when searched
        $searchCount = "UPDATE project_movies 
                SET SearchCount = SearchCount + 1 WHERE Title LIKE '%$title%'";
        //Switch makes sure that picking 'G' doesn't also show 'PG' and others
        switch ($_POST['rating']) {
            case 'R':
                $search = "SELECT * FROM project_movies 
                WHERE Title LIKE '%$title%' AND Genre LIKE '%$genre%'
                AND Year LIKE '%$year%' AND Rating LIKE 'R'";
                break;
            case 'G':
                $search = "SELECT * FROM project_movies 
                WHERE Title LIKE '%$title%' AND Genre LIKE '%$genre%'
                AND Year LIKE '%$year%' AND Rating LIKE 'G'";
                break;
            case 'PG':
                $search = "SELECT * FROM project_movies 
                WHERE Title LIKE '%$title%' AND Genre LIKE '%$genre%'
                AND Year LIKE '%$year%' AND Rating LIKE 'PG'";
                break;
            default:
                $search = "SELECT * FROM project_movies 
                WHERE Title LIKE '%$title%' AND Genre LIKE '%$genre%'
                AND Year LIKE '%$year%' AND Rating LIKE '%$rating%'";
                break;
        }

        //SQL Execution
        $result = $connection->query($search);
        if ($result->num_rows > 0) {
            //Table Head
            echo "<table><tr><th>Title</th><th>Genre</th>
                    <th>Year</th><th>Rating</th></tr>";
            //Print Results
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["Title"]."</td><td>".$row["Genre"].
                    "</td><td>".$row["Year"]."</td><td>".$row["Rating"]."</td></tr>";
            }
            echo "</table>";
        } else {
            //No results message
            echo "Sorry, there are no results that match that search.";
        }
        //Add search count
        $connection->query($searchCount);
        //Close connection
        $connection->close();
    }
    ?>
</body>
</html>
