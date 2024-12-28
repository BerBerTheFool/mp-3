<?php

include_once("config.php");

// Check if the form was submitted
if (isset($_POST["submit"])) {
    // Retrieve the form data
    $username = $_POST["username"];
    $is_admin = 1;
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $gender = $_POST["gender"];

    // Insert the user into the database
    $sql = "INSERT INTO users (username, is_admin, first_name, last_name, password, email, birthday, gender) VALUES ('$username', '$is_admin','$firstname','$lastname','$password', '$email', '$birthday', '$gender')";
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
    <link rel="stylesheet" href="">
</head>
<body>    
    <section>
        <span></span>
        <span></span>
        <div class="registration">
            <form method="post" action="">
                <h1>Admin Registration Form</h1>

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
                    <label>Gender:</label>
                    <input type="radio" id="F" name="gender" value="Female"> Female
                    <input type="radio" id="M" name="gender" value="Male"> Male
                </div>

                <div class="form-element">
                    <label>Birthday:</label>
                    <input type="date" id="birthday" name="birthday"> 
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
