<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $conn = new mysqli("localhost", "root", "", "ethnicshop_db");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $id;
            header("Location: homepage.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to top left, #f0f8ff, #d1e8e2);
            font-family: 'Arial', sans-serif;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(0);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-header {
            background: linear-gradient
            color: white;
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            padding: 20px 0;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .form-control {
            border-radius: 25px;
            padding: 12px 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease-in-out;
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            border-color: #9b59b6;
        }

        .btn-primary {
            background: linear-gradient(to right, #9b59b6, #8e44ad);
            border-radius: 25px;
            padding: 14px;
            font-size: 16px;
            width: 100%;
            border: none;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #8e44ad, #9b59b6);
            cursor: pointer;
        }

        .alert-danger {
            font-size: 14px;
            text-align: center;
            font-weight: bold;
            background: rgba(255, 99, 71, 0.1);
            color: #d9534f;
        }

        .forgot-password-link {
            font-size: 14px;
            text-decoration: none;
            color: #8e44ad;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        .forgot-password-link:hover {
            color: #9b59b6;
            text-decoration: underline;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="col-md-4">
        <div class="card p-4">
            <div class="card-header">
                Login form
            </div>
            <?php if (!empty($error)) echo '<div class="alert alert-danger">'.$error.'</div>'; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-primary" type="submit">Login</button>
            </form>

            <div class="mt-3 text-center">
                <a href="forgotpassword.php" class="forgot-password-link">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
