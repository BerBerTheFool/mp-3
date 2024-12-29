<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   
   echo 'You logged out';
   header('Refresh: 1; URL = login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <div class="container">
        <h1>You logged out</h1>
        <p>Redirecting to the login page...</p>
        <div class="loader"></div>
    </div>
    <?php
        header('Refresh: 3; URL = login.php');
    ?>
</body>
</html>