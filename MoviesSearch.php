<!DOCTYPE html>

    <!-- 
        This php file is the SEARCH page of the website.
        This file is a page on its own and should be referenced as such.

        Author: Blayde Dietsch
        Date: 12/11/2019
    -->

    <head>
        <title>Movies: Search</title>
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
                <?php
                    require'functions/Search.php';
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