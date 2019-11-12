<!DOCTYPE html>

    <!-- 
        This php file is the welcome page of the website.
        This file is a page on its own and should be referenced as such.
        This welcome page includes top 10 results

        Author: Blayde Dietsch
        Date: 12/11/2019
    -->

    <head>
        <title>Movies!</title>
        <link rel="stylesheet" type="text/css" href="MovieDatabasecss.css"/>
    </head>

    <body>
        <header>
            <?php
                require_once'functions/nav.php'; 
            ?>
        </header>

        <div class="container">
            <div class="content">
                <h1>Welcome To The Home Menu</h1>

                <p>Welcome to the database for the Rental Movie Collection.
                   This database can provide you with all the relevant information 
                   regarding the movies held within the database. Below you can see
                    the top 10 movies searched all time. 
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
        </div>
        
        <footer>
            <?php
                require_once'functions/footer.php'; 
            ?>      
        </footer>
    </body>
</html>