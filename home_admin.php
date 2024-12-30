<?php
session_start();
require_once("config.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit;
}


// Handle form submission for Zodiac sign entries
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sign_name = trim($_POST['sign_name']);
    $description = trim($_POST['description']);
    $image_url = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image_url);

    // Validate and upload the image
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $query = "INSERT INTO zodiac (sign_name, description, image_url, start_date, end_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $sign_name, $description, $target_file, $_POST['start_date'], $_POST['end_date']);
        if (mysqli_stmt_execute($stmt)) {
            $message = "Zodiac sign added successfully!";
        } else {
            $message = "Error adding zodiac sign.";
        }
    } else {
        $message = "Error uploading image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="stylecss.css">
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <p>Welcome, Admin! You can manage Zodiac signs and user details here.</p>
        <p>Instructions:</p>
        <ol>
            <li>Create entries for Zodiac Sign descriptions, images, and user details.</li>
            <li>Ensure the uploaded image is in JPG format.</li>
            <li>Users will see their Zodiac details and daily horoscope on their dashboard.</li>
        </ol>

        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <h3>Add Zodiac Sign</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="sign_name">Zodiac Sign Name:</label>
                <input type="text" id="sign_name" name="sign_name" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image (JPG only):</label>
                <input type="file" id="image" name="image" accept="image/jpeg" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>
            <button type="submit">Add Zodiac Sign</button>
        </form>

        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
