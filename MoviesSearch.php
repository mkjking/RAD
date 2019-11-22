<!DOCTYPE html>

    <!-- 
        This php file is the SEARCH page of the website.
        This file is a page on its own and should be referenced as such.

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 12/11/2019
    -->

    <head>
        <title>Movies: Search</title>
        <link rel="stylesheet" type="text/css" href="MovieDatabasecss.css"/>
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
                <?php
                    require'functions/Search.php';
                    //Likes and dislikes from JS
                    $id = $_GET['Likeid'];
                    if($id) {
                        $sql = "UPDATE movies_tbl SET
                                likes = likes + 1
                                WHERE ID = ".$id.";";
                        mysqli_query($conn, $sql);
                        echo mysqli_error($conn);
                    }
                                
                    $id = $_GET['Dislikeid'];
                    if($id) {
                        $sql = "UPDATE movies_tbl SET
                                likes = likes - 1
                                WHERE ID = ".$id.";";
                        mysqli_query($conn, $sql);
                    }                    
                ?>                
            </div>
        </div>
        
        <footer>
            <?php
                require_once'functions/footer.php'; 
            ?>      
        </footer>
    </body>
</html>