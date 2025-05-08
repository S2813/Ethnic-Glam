<?php
session_start();
include 'db.php';

// Fetch products
$products = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ethnic Glam</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background-color: #5ed3cd;
            position: relative;
        }
        header {
            background: #201313;
            color: rgb(216, 214, 214);
            padding: 20px;
            font-size: 24px;
        }
        
        .about, .contact {
            background: rgb(226, 65, 65);
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-btn {
            display: inline-block;
            background: #22182e;
            color: rgb(58, 168, 211);
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .login-btn:hover {
            background: #A0522D;
        }
        
            
        .corner-top-left {
            top: 0;
            left: 0;
        }
        .corner-top-right {
            top: 0;
            right: 0;
        }
        .corner-bottom-left {
            bottom: 0;
            left: 0;
        }
        .corner-bottom-right {
            bottom: 0;
            right: 0;
        }
        .carousel {
      height: 500px;
    }
    .carousel-inner, .carousel-item {
      height: 100%;
    }
    .carousel-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .carousel-caption {
      background: rgba(0, 0, 0, 0.5);
      padding: 20px;
      border-radius: 12px;
      animation: fadeIn 2s ease-in-out;
    }
    @keyframes fadeIn {
      from {opacity: 0;}
      to {opacity: 1;}
    }
    body, html {
  margin:0;
  padding: 0;
  width: 100%;
       }
    </style>

</head>
<body>
   
    <!-- Your content, products, etc. -->
    <div class="corner-design corner-top-left"></div>
    <div class="corner-design corner-top-right"></div>
    <div class="corner-design corner-bottom-left"></div>
    <div class="corner-design corner-bottom-right"></div>
 
    <!-- Navbar  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="homepage.php">Ethnic Glam</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center">

        <li class="nav-item me-2">
          <a class="btn btn-warning" href="cart.php">🛒 Cart</a>
        </li>

        <?php if (isset($_SESSION["user_id"])): ?>
          <li class="nav-item">
            <a class="btn btn-outline-danger" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item me-2">
            <a class="btn btn-outline-light" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-info" href="registration.php">Register</a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>


<!-- Carousel -->
<div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="e.jpg"  class="d-block w-100" style="height: 500px; object-fit: contain; background: rgb(78, 55, 107);" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h1>Welcome to Ethnic Glam</h1>
        <p>Discover the beauty of traditional wear with a modern twist</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="b2.jpg"  class="d-block w-100" style="height: 500px; object-fit: contain; background: rgb(78, 55, 107);" alt="...">
    </div>
    <div class="carousel-item">
      <img src="sa.jpg"  class="d-block w-100" style="height: 500px; object-fit: contain; background: rgb(78, 55, 107);" alt="...">
    </div>
    <div class="carousel-item">
      <img src="pic1.jpg"   class="d-block w-100" style="height:500px; object-fit: contain; background: rgb(78, 55, 107);" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
    <div class="about">
            <h2>About Ethnic Glam</h2>
            <p>Ethnicglam is a premier fashion brand specializing in ethnic wear. We provide a wide range of beautifully designed sarees, lehengas, kurtas, and more. Our goal is to celebrate cultural heritage with a modern twist. Inspired by the richness of Indian traditions, our collection is designed to cater to diverse tastes, blending classic elegance with contemporary styles. Each outfit is a masterpiece, crafted with attention to detail and an unwavering commitment to quality.</p>
            <h2>Traditional Elegance, Modern Appeal</h2>
        <p>At Ethnic Glam, we bring you the finest ethnic wear that blends tradition with contemporary fashion. Our collection is crafted to make you look and feel elegant. Whether you're looking for a regal saree, a trendy lehenga, or a stylish kurta, we have something for every occasion. Our designs showcase intricate craftsmanship and premium fabrics, ensuring that you always stand out with grace and sophistication.</p>
        </div>
        <div class="container mt-4">
  <h2 class="text-center mb-4">Our Products</h2>

  <!-- Products Grid -->
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
    <?php while ($row = $products->fetch_assoc()): ?>
      <div class="col">
        <div class="card h-100 shadow-sm">
        <img src="<?= $row['image'] ?>" class="cart-img" alt="<?= $row['name'] ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= $row['name'] ?></h5>
            <p class="card-text">$<?= number_format($row['price'], 2) ?></p>
            <form method="POST" action="cart.php" class="mt-auto">
  <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
  <input type="hidden" name="action" value="add"> <!-- Important! -->
  <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
</form>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

      </div>
    </div>
  </div>
</div>
       

     <div class="contact">
            <h2>Contact Us</h2>
            <p>Phone: +123 456 7890</p>
            <p>Email: support@ethnicglam.com</p>
            
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
