<!DOCTYPE html>

    <!-- 
        This php file is the welcome page of the website.
        This file is a page on its own and should be referenced as such.
        This welcome page includes top 10 results

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 12/11/2019
    -->

    <head>
        <title>Movies!</title>
        <link rel="stylesheet" type="text/css" href="MovieDatabasecss.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <header>
            <?php
                require_once'functions/nav.php'; 
            ?>
        </header>

        <div class="container">
            <div class="content">
                <h1>Welcome To ACME Entertainment Movies</h1>

                <p>Welcome to the database for the Rental Movie Collection.
                   This website can provide you with all the relevant information
                   regarding the movies held within the database. Below you can see
                    the top 10 movies searched of all time.
                </p>

                <?php 
                    require'functions/Connection.php';
                ?>
            </div>
            <div class="content">
                <?php
                    require'functions/Top10Results.php';
                ?>
            </div>
            <div class="content">
                <?php
                    require'functions/Top10Rated.php';
                ?>
            </div>
            <div class="content">
                <!--Signup page link-->
                <p >Want to receive newsletters and other information about movies? Click below to signup for our Newsletter program!</p>
                <a href="Signup.php"><h1>SIGNUP!</h1></a>
            </div>
        </div>
        
        <footer>
            <?php
                require_once'functions/footer.php'; 
            ?>      
        </footer>
    </body>
</html>