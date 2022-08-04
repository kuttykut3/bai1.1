<?php ob_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="libs/style.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" type="image/x-icon" href="Pop cat open.ico">

    </head>
    <body>
        <main style="background:white;">
            <div class="container" style="position:relative; top: 150px;">
            <div class="login-form">
                <form action="" method="post">
                    <h1>Login</h1>

                <?php
                    // define("IN_SITE", true);
                    
                    include 'libs/config.php'; 
                    if(isset($_POST['submit']) && validate($_POST['username']) && validate($_POST['password'])) {
                        $username = $_POST['username'];
                        $password =md5($_POST['password'].'md5');

                        $sql = "SELECT * FROM users WHERE username='$username' and password='$password'";
                        $query = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($query);

                        if(mysqli_num_rows($query) > 0) {
                            
                            session_start();
                            $_SESSION['username'] = $row['username'];
                            header("location:home.php");
                           
                           
                        } else echo "Please check your username or password!";
                    } 
                ob_end_flush();
                ?>

                    <div class="input-box">
                        <i ></i>
                        <input name="username" type="text" placeholder="Username" required>
                    </div>
                    <div class="input-box">
                        <i ></i>
                        <input name="password" type="password" placeholder="Password" required>
                    </div>
                    <a href="register.php">Register now</a>
                    <div class="btn-box">
                        <button name="submit" type="submit">
                            Login
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </main>
    </body>
</html>