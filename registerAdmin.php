<?php
include_once("config.php");
include_once("getZodiacSign.php"); // Include the zodiac sign function

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $gender = $_POST["gender"];

    // Determine the zodiac sign using the function from getzodiacsign.php
    $zodiac_sign = getZodiacSign($birthday);

    // Set the is_admin field to 1 (for admin registration)
    $is_admin = 1;

    // Insert the user into the database, including is_admin
    $sql = "INSERT INTO users (username, first_name, last_name, password, email, birthday, gender, zodiac_sign, is_admin) 
            VALUES ('$username', '$firstname', '$lastname', '$password', '$email', '$birthday', '$gender', '$zodiac_sign', '$is_admin')";

    if (mysqli_query($conn, $sql)) {
        echo "<b>Admin registration successful!</b>";
        header('Refresh: 1; URL = login.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
</head>
<body>
    <form action="registeradmin.php" method="post">
        <label>Username:</label><input type="text" name="username" required><br>
        <label>First Name:</label><input type="text" name="firstname" required><br>
        <label>Last Name:</label><input type="text" name="lastname" required><br>
        <label>Password:</label><input type="password" name="password" required><br>
        <label>Email:</label><input type="email" name="email" required><br>
        <label>Birthday:</label><input type="date" name="birthday" required><br>
        <label>Gender:</label>
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br>
        <button type="submit" name="submit">Register</button>
    </form>
</body>
</html>
