<?php
session_start();
require_once("config.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit;
}

// Handle Zodiac sign form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_zodiac'])) {
    $sign_name = trim($_POST['sign_name']);
    $description = trim($_POST['description']);
    $image_url = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image_url);

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

// Handle user update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];

    $query = "UPDATE users SET first_name=?, last_name=?, email=?, birthday=?, gender=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssi", $firstname, $lastname, $email, $birthday, $gender, $user_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $message = "User updated successfully!";
    } else {
        $message = "Error updating user.";
    }
}

// Fetch all users
$query = "SELECT * FROM users WHERE is_admin != 1";
$result = mysqli_query($conn, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .tabs {
            margin-bottom: 20px;
        }
        .tab-button {
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .edit-form {
            display: none;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="tabs">
            <button class="tab-button" onclick="showTab('zodiac')">Manage Zodiac Signs</button>
            <button class="tab-button" onclick="showTab('users')">Manage Users</button>
        </div>

        <div id="zodiac" class="tab-content">
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
                <button type="submit" name="add_zodiac">Add Zodiac Sign</button>
            </form>
        </div>

        <div id="users" class="tab-content">
            <h3>User Management</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Birthday</th>
                        <th>Gender</th>
                        <th>Zodiac Sign</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['birthday']); ?></td>
                            <td><?php echo htmlspecialchars($user['gender']); ?></td>
                            <td><?php echo htmlspecialchars($user['zodiac_sign']); ?></td>
                            <td>
                                <button onclick="showEditForm(<?php echo $user['id']; ?>)">Edit</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <form id="edit-form-<?php echo $user['id']; ?>" class="edit-form" method="POST">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <div class="form-group">
                                        <label>First Name:</label>
                                        <input type="text" name="firstname" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name:</label>
                                        <input type="text" name="lastname" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Birthday:</label>
                                        <input type="date" name="birthday" value="<?php echo htmlspecialchars($user['birthday']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Gender:</label>
                                        <select name="gender" required>
                                            <option value="Male" <?php echo $user['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                                            <option value="Female" <?php echo $user['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                                            <option value="Undisclosed" <?php echo $user['gender'] == 'Undisclosed' ? 'selected' : ''; ?>>Undisclosed</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="update_user">Update User</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <a href="logout.php">Logout</a>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.style.display = 'none';
            });
            // Show selected tab content
            document.getElementById(tabName).style.display = 'block';
        }

        function showEditForm(userId) {
            const form = document.getElementById(`edit-form-${userId}`);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        // Show zodiac tab by default
        showTab('zodiac');
    </script>
</body>
</html>