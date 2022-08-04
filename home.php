<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="icon" type="image/x-icon" href="Pop cat open.ico">
        <link href="libs/home.css" rel="stylesheet" type="text/css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <h4> Task </h4>
        <form action="" method="post">
        <?php
            include 'libs/config.php'; 
            if(isset($_POST['new_task']))
            {
                $task_name = $_POST['data'];
                $sql = "INSERT INTO `tasks`(`task_name`) VALUES ('$task_name')";
                $query = mysqli_query($conn, $sql);
                if(!$query) {
                    echo("Error description: " . mysqli_error($conn));
                } 
            }
        ?>
            <div class="input-box">
                <i ></i>
                <input name="data" type="text">
            </div>
            <div class="btn-box">
                <button name="new_task" type="submit">
                    Add Task
                </button>
            </div>
        </form>
        <h5> Current Tasks </h5>
        <h4 class = "taskDB"> Task </h4>
       <?php 
       if (isset($_SESSION['username']))
       {

            $sql = "SELECT id,task_name FROM tasks";
            $query = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($query)) {
                $task_name = $row["task_name"];
                $id = $row["id"];
            ?>
            <div id = "task_name">
            <?php echo $task_name ?>
            <form id = "delete" action="" method="POST" onsubmit="return confirm('Are you sure?');">
				<button class="remove" type="submit" name="delete" value=<?php echo $row['id']?> >Delete</button>
			</form>
            </div>
            <?php 
            }
            ?>
            <?php
       }

       else{
           die(header("location: login.php"));   
       }
       ?>
    <footer>
        <p>Click here to logout: 
        <a href="logout.php">Logout</a></p>
    </footer>
    </body>
    <?php
	if(isset($_POST['delete'])) {
		$id = $_POST['delete'];
		$sql = "DELETE FROM `tasks` WHERE id='$id'";
		$query = mysqli_query($conn, $sql);
		header("refresh: 0");
	}
?> 
</html>