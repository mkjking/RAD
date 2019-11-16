<!DOCTYPE html>

    <!-- 
        This php file is the SIGNUP page of the website.
        This file is a page on its own and should be referenced as such.
        This welcome page allows a user to sign up to the sites account

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 16/11/2019
    -->

    <head>
        <title>Movies: Signup</title>
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
                <h1>Sign up!</h1>

                <p>Welcome to the signup page, here you can create an account with us and choose to receive the monthly email or News blast emails!
                </p>

                <?php 
                    require'functions/Connection.php';
                ?>
            </div>
            <div class="content">
            <?php 
                    require'functions/CreateNewUser.php';
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