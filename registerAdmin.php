<?php
include_once("config.php");

function getZodiacSign($birthdate) {
    $zodiac = [
        ['start' => '01-20', 'end' => '02-18', 'sign' => 'Aquarius'],
        ['start' => '02-19', 'end' => '03-20', 'sign' => 'Pisces'],
        ['start' => '03-21', 'end' => '04-19', 'sign' => 'Aries'],
        ['start' => '04-20', 'end' => '05-20', 'sign' => 'Taurus'],
        ['start' => '05-21', 'end' => '06-20', 'sign' => 'Gemini'],
        ['start' => '06-21', 'end' => '07-22', 'sign' => 'Cancer'],
        ['start' => '07-23', 'end' => '08-22', 'sign' => 'Leo'],
        ['start' => '08-23', 'end' => '09-22', 'sign' => 'Virgo'],
        ['start' => '09-23', 'end' => '10-22', 'sign' => 'Libra'],
        ['start' => '10-23', 'end' => '11-21', 'sign' => 'Scorpio'],
        ['start' => '11-22', 'end' => '12-21', 'sign' => 'Sagittarius'],
        ['start' => '12-22', 'end' => '01-19', 'sign' => 'Capricorn']
    ];

    $date = date('m-d', strtotime($birthdate));

    foreach ($zodiac as $z) {
        if (($date >= $z['start'] && $date <= '12-31') || ($date >= '01-01' && $date <= $z['end'])) {
            return $z['sign'];
        }
    }
    return 'Unknown';
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $gender = $_POST["gender"];

    // Determine the zodiac sign
    $zodiac_sign = getZodiacSign($birthday);

    // Insert the user into the database
    $sql = "INSERT INTO users (username, first_name, last_name, password, email, birthday, gender, zodiac_sign) VALUES ('$username', '$firstname', '$lastname', '$password', '$email', '$birthday', '$gender', '$zodiac_sign')";
    if (mysqli_query($conn, $sql)) {
        echo "<b>Admin registration successful!</b>";
        header('Refresh: 1; URL = adminhome.php');
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
