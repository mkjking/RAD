<!DOCTYPE html>

    <!-- 
        This php file is the welcome page of the website.
        This file is a page on its own and should be referenced as such.
        This welcome page includes top 10 results

        Author: Blayde Dietsch
        Date: 12/11/2019
    -->

    <head>
        <title>Movie Rentals</title>
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

                <p>This is the home menu. now yes,
                    this is a beautiful website.
                    But it is so much more.
                    Here, you can do many things.
                    Just click on the tabs and find out!
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