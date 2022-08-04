<?php ob_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
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
                    <h1>Register</h1>

<?php 
    include 'libs/config.php';
    session_start();
    if(isset($_POST['submit']) && validate_name($_POST['name']) && validate($_POST['username']) && validate($_POST['password']) && validate($_POST['repassword']) && validate_email($_POST['email']) && $_POST['password'] == $_POST['repassword']) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password =md5($_POST['password'].'md5');
        $email = $_POST['email'];

        $sql1 = "SELECT * FROM users WHERE username='$username'";
        $query1 = mysqli_query($conn, $sql1);

        $sql2 = "SELECT * FROM users WHERE email='$email'";
        $query2 = mysqli_query($conn, $sql2);

        if(mysqli_num_rows($query1) > 0) {
            echo "This username has been registered, please enter another username!";
        }
        else if(mysqli_num_rows($query2) > 0) {
            echo "This email has been registered, please enter another email!";
        } else {
            $sql = "INSERT INTO `users` (`username`, `password`, `fullname`, `email`) VALUES ('$username', '$password', '$name', '$email')";
            $query = mysqli_query($conn, $sql);
            echo "--query";
            if(!$query) {
                echo("Error description: " . mysqli_error($conn));
            } else echo "Success";
            $_SESSION['user'] = $username;

            header("location:login.php");
        }
    }
    elseif(isset($_POST['email']) && !validate_email($_POST['email'])) {
        ?>
            <br><p style="position: relative;left:120px;"><?php echo "Please enter the correct email!"; ?></p>
        <?php
    }
    elseif(isset($_POST['name']) && !validate_name($_POST['name'])) {
        ?>
            <br><p style="position: relative;left:120px;"><?php echo "Please enter the correct full name!"; ?></p>
        <?php
    }

    elseif(isset($_POST['password']) && isset($_POST['password']) && !is_passwdMatched()){
        ?>
            <br><p style="position: relative;left:120px;"><?php echo "Password isn't match! Please try again"; ?></p>
        <?php
    }
    ob_end_flush();
?>

                    <div class="input-box">
                        <i ></i>
                        <input name="name" type="text" placeholder="Fullname" required>
                    </div>
                    <div class="input-box">
                        <i ></i>
                        <input name="username" type="text" placeholder="Username" required>
                    </div>
                    <div class="input-box">
                        <i ></i>
                        <input name="password" type="password" placeholder="Password" required>
                    </div>
                    <div class="input-box">
                        <i ></i>
                        <input name="repassword" type="password" placeholder="Re-Password" required>
                    </div>
                    <div class="input-box">
                        <i ></i>
                        <input name="email" type="text" placeholder="email" required>
                    </div>
                    <a href="login.php">I had account! Login</a>
                    <div class="btn-box">
                        <button name="submit" type="submit">
                            Register
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </main>
    </body>
</html>

