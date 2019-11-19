<!DOCTYPE html>

    <!-- 
        This php file is the UNSUBSCRIBE page of the website.
        This file is a page on its own and should be referenced as such.
        This unsubscribe page allows users to request to be removed from the newsletter subscription

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 17/11/2019
    -->

    <head>
        <title>Movies: Unsubscribe</title>
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
                <h1>Unsubscribe?</h1>

                <?php 
                    require'functions/Connection.php';
                ?>
            </div>

            <div class="content">
                <form action="Unsubscribe.php" method="post">
                    <label>Enter email to request cancellation: </label>
                    <input type="text" name="email" placeholder="JohnSmith@email.com"><br>
                    <p class="note">Note: Your account will be permanently deleted, <br>
                    and you will have to signup again to resubscribe.</p>
                    <input type="submit" name="btnRemove" value="Request Cancellation" />
                </form>

                <?php
                    //Perform a check for button click 
                    if (isset($_POST['btnRemove'])){

                        //Retreive password from input
                        $email = $_POST["email"];

                        require 'functions/SendEmail.php';
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