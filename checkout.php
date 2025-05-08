<?php
session_start();           // ✅ REQUIRED at the top!
include 'db.php';          // Ensure this file only connects DB (no extra session_start here)

// Debug (optional)
// echo "<pre>"; print_r($_SESSION); echo "</pre>";  // Uncomment this line for debugging

// 1. Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<div class='alert alert-danger text-center'>Please <a href='login.php'>log in</a> before checking out.</div>";
    exit;
}

// 2. Check if cart is not empty
if (empty($_SESSION['cart'])) {
    echo "<div class='alert alert-warning text-center'>Your cart is empty. <a href='homepage.php'>Continue Shopping</a></div>";
    exit;
}

$user_id = $_SESSION['user_id'];
$cart = $_SESSION['cart'];

// 3. Insert into orders table
$conn->query("INSERT INTO orders (user_id) VALUES ($user_id)");
$order_id = $conn->insert_id;

// 4. Insert into order_items
foreach ($cart as $product_id => $quantity) {
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $order_id, $product_id, $quantity);
    $stmt->execute();
}

// 5. Clear cart session
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            background-color: white;
        }
        .btn-primary {
            background-color: #4CAF50;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            color: white;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #45a049;
        }
        h2 {
            color: #4CAF50;
            font-size: 2.5em;
            font-weight: bold;
        }
        p {
            font-size: 1.2em;
            color: #555;
        }
        .alert {
            font-size: 1.2em;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="text-center">
            <h2>✅ Order Placed Successfully!</h2>
            <p>Your order number is <strong>#<?php echo $order_id; ?></strong></p>
            <p>Thank you for shopping with us. Your order will be processed shortly!</p>
            <a href="homepage.php" class="btn btn-primary">Continue Shopping</a>
            <br><br>
          
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

