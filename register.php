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
    $birthday = $_POST["birthday"];
    $gender = $_POST["gender"];

    // Insert the user into the database
    $sql = "INSERT INTO users (username, first_name, last_name, password, email, birthday, gender) VALUES ('$username', '$firstname','$lastname','$password', '$email', '$birthday', '$gender')";
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
    <link rel="stylesheet" href="./stylecss.css">
</head>
<body>    
    <section>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <div class="registration">
            <form method="post" action="">
                <h1>User Registration Form</h1>

                <?php if(isset($error_message)): ?>
                    <div class="error"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <div class="form-element">
                    <input type="text" placeholder="Username" name="username" required>
                </div>

                <div class="form-element">
                    <input type="text" placeholder="First Name"name="firstname" required>
                </div>

                <div class="form-element">
                    <input type="text" placeholder="Last Name"name="lastname" required>
                </div>
                    

                <div class="radio">
                <h3> Gender </h3> 

                <input type="radio" id="fem" name="gender" value="Female" checked>
                    <label for="fem">Female</label>

                    <input type="radio" id="male" name="gender" value="Male">
                    <label for="male">Male</label>

                    <input type="radio" id="undisclosed" name="gender" value="Undisclosed">
                    <label for="undisclosed">Undisclosed</label> 
                </div>

                <div class="form-element">
                    <input type="date" id="birthday" name="birthday"> 
                </div>

                <div class="form-element">
                    <input type="password" placeholder="Password" name="password" required>
                </div>

                <div class="form-element">
                    <input type="email" placeholder="Email Address" name="email" required>
                </div>

                <div class="links">
                        <a href="login.php">Already have an account?</a>
                    </div>

                <div class="form-element">
                    <input type="submit" name="submit" value="Submit">
                </div>
            </form>
        </div>
    </section>
</body>
</html>
