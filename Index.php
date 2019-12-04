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
            /**
            PHP version 7

            @category SQL

            @package RAD

            @author Original Author <mitchel_king@icloud.com>

            @license http://www.php.net/license PHP license 7

            @link http:/pear.php.net
             **/
            /** 
            Nav file
            
            @file nav.php

            renders the navigation bar
             **/
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
                require 'functions/StoreTop10.php';
                include 'functions/Top10Rated.php';
                ?>
            </div>
            <div class="content">
                <!--Signup page link-->
                <p title="Want to receive newsletters and other information about movies?
                 Click below to signup for our Newsletter program!" >Want to receive newsletters and other information about movies?
                 Click below to signup for our Newsletter program!</p>
                
                <div class="signupcontainer">
                    <div class="signup">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <a title="Signup" href="Signup.php" tabindex="6"><h1 style="color:#5AB9EA;">SIGNUP!</h1></a>
                    </div>    
                </div>
            </div>
        </div>
        
        <footer>
            <?php
                require_once'functions/footer.php'; 
            ?>      
        </footer>
    </body>
</html>