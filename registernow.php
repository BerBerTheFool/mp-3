<?php

include_once("config.php");

// Check if the form was submitted
if (isset($_POST["submit"])) {
    // Retrieve the form data
    $username = $_POST["username"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Insert the user into the database
    $sql = "INSERT INTO users (username, first_name, last_name, password, email) VALUES ('$username', '$firstname','$lastname','$password', '$email')";
    if (mysqli_query($conn, $sql)) {

   echo "<b>Registration successful!<b>";
   header('Refresh: 1; URL = login.php');

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!doctype html>
<html lang="en">  
<head>  
    <meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
    <title>User Registration Form</title>  
    <link rel="stylesheet" href="./stylesheet.css">
</head>
<body>    
    <section>
        <span></span>
        <span></span>
        <div class="registration">
            <form method="post" action="">
                <h1>User Registration Form</h1>

                <?php if(isset($error_message)): ?>
                    <div class="error"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <div class="form-element">
                    <label>Username:</label>
                    <input type="text" name="username" required>
                </div>

                <div class="form-element">
                    <label>Firstname:</label>
                    <input type="text" name="firstname" required>
                </div>

                <div class="form-element">
                    <label>Lastname:</label>
                    <input type="text" name="lastname" required>
                </div>

                <div class="form-element">
                    <label>Password:</label>
                    <input type="password" name="password" required>
                </div>

                <div class="form-element">
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-element">
                    <input type="submit" name="submit" value="Submit">
                </div>
            </form>
        </div>
    </section>
</body>
</html>
