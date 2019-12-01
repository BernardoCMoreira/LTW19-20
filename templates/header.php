<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>
        HomeFull
    </title>
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <header>
        <h1> <a href="MainPage.php">HomeFull </a></h1>
        <img src="images/logo.png" alt="Logo " width="150" height="150" />
        
        <div id="signup">
            <?php
                if (isset($_SESSION['username'])){ ?>
                    <div class="usernameContainer">
                        <form action="action_logout.php">
                            <?=$_SESSION['username']?>
                            <input type="submit" value="Logout">
                        </form>
                    </div>
                <?php }
                else{ ?>
                    <a href="register.php">Register</a>
                    <a href="login.php">Login</a>
                <?php }    
            ?>
        </div>
    </header>

