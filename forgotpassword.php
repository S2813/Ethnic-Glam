<?php
session_start();
include 'db.php';

$error = "";
$success = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the POST values are set before using them
    if (isset($_POST["username"], $_POST["new_password"], $_POST["confirm_password"])) {
        $username = $_POST["username"];
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];

        // Validate the input fields
        if (empty($username) || empty($new_password) || empty($confirm_password)) {
            $error = "All fields are required.";
        } elseif ($new_password !== $confirm_password) {
            $error = "Passwords do not match.";
        } else {
            // Check if the username exists in the database
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Username exists, update the password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
                $stmt->bind_param("ss", $hashed_password, $username);
                if ($stmt->execute()) {
                    $success = "Your password has been successfully updated!";
                } else {
                    $error = "Something went wrong. Please try again.";
                }
            } else {
                $error = "Username not found.";
            }

            $stmt->close();
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4 shadow-sm">
                <h4 class="text-center mb-4">Forgot Password</h4>
                <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
                <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <button class="btn btn-success w-100" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
