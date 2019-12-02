<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>
        HomeFull
    </title>
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/script.js" defer></script>
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

    <nav id="menu">
        <ul>
            <li><a href="user.php">User</a></li>
            <li><a href="rents.php">Rents</a></li>
            <li><a href="aboutUs.php">About Us</a></li>
            <li><a href="contacts.php">Contact Us</a></li>
        </ul>
    </nav>

    <?php
    include_once('config/session.php');
    $errors = getErrorMessages();foreach ($errors as $error) {
        echo "<script type=\"text/javascript\">alert('$error');</script>";
    } ?>
    <?php $successes = getSuccessMessages();foreach ($successes as $success) { 
        echo "<script type=\"text/javascript\">alert('$success');</script>";
    } clearMessages(); ?>
    </section>
