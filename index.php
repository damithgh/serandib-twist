<?php 
session_start(); 
include 'db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Home - Serandib Twist</title>
    <style>
        /* --- Smooth Animations & UI --- */
        body { background-color: #fdfaf5; font-family: 'Poppins', sans-serif; }

        .category-card {
            overflow: hidden;
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            background: #fff;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(111, 78, 55, 0.2);
        }

        .category-card img {
            transition: transform 0.6s ease;
            height: 250px;
            object-fit: cover;
        }

        .category-card:hover img {
            transform: scale(1.1);
        }

        .btn-shop {
            background-color: #6f4e37;
            color: white;
            border-radius: 50px;
            padding: 8px 25px;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
        }

        .btn-shop:hover {
            background-color: #3d2b1f;
            color: #f1c40f;
            transform: scale(1.05);
        }

        /* --- Navbar Dropdown --- */
        .navbar-nav .dropdown-menu {
            display: block !important;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-20px) scaleY(0);
            transform-origin: top;
            transition: all 0.3s ease;
            border: none;
            border-top: 3px solid #f1c40f;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .nav-item.dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scaleY(1);
        }

        .carousel-caption {
            bottom: 25%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            padding: 30px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color:#6f4e37; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="images/logo.png" alt="Logo" height="80">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-semibold">
        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-bs-toggle="dropdown">Shop</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="srilankanspices.php">Sri Lankan Spices</a></li>
            <li><a class="dropdown-item" href="cupcakes.php">Cupcakes</a></li>
            <li><a class="dropdown-item" href="coffee.php">Coffee & Beverages</a></li>
            <li><a class="dropdown-item" href="tea.php">Tea</a></li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link" href="bestsellers.php">Best Sellers</a></li>
        <li class="nav-item"><a class="nav-link" href="ourstory.php">Our Story</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
        
        <li class="nav-item">
          <a class="nav-link text-white position-relative ms-lg-2" href="cart.php">
          
            <span class="badge rounded-pill bg-danger">
              <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
            </span>
          </a>
        </li>
      </ul>

      <div class="d-flex align-items-center gap-3">
        <form class="d-flex" action="search.php" method="GET">
          <input class="form-control me-2 rounded-pill" name="query" type="search" placeholder="Search..." required>
          <button class="btn btn-outline-light rounded-pill" type="submit">Search</button>
        </form>
        <a class="nav-link text-warning fw-bold border border-warning px-3 py-1 rounded-pill" href="login.php">Admin</a>
      </div>
    </div>
  </div>
</nav>

<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/banner.jpg" class="d-block w-100" style="height: 550px; object-fit: cover;" alt="Banner">
      <div class="carousel-caption d-none d-md-block text-white text-center">
        <h1 class="display-3 fw-bold">Serandib Twist</h1>
        <p class="fs-4">Bringing the finest Sri Lankan flavors to your doorstep.</p>
        <a href="#categories" class="btn btn-warning btn-lg rounded-pill fw-bold px-5 shadow">Explore Shop</a>
      </div>
    </div>
  </div>
</div>

<section id="categories" class="py-5">
  <div class="container text-center">
    <h2 class="mb-5 fw-bold" style="color: #3d2b1f; font-size: 2.8rem;">Shop by Category</h2>
    <div class="row g-4">
      
      <div class="col-md-3">
        <div class="card h-100 category-card shadow-sm">
          <img src="images/coffee.jpg" class="card-img-top" alt="Coffee">
          <div class="card-body">
            <h4 class="fw-bold" style="color: #6f4e37;">Coffee</h4>
            <a href="coffee.php" class="btn btn-shop mt-2">Shop Now</a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card h-100 category-card shadow-sm">
          <img src="images/spices.jpg" class="card-img-top" alt="Spices">
          <div class="card-body">
            <h4 class="fw-bold" style="color: #6f4e37;">Spices</h4>
            <a href="srilankanspices.php" class="btn btn-shop mt-2">Shop Now</a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card h-100 category-card shadow-sm">
          <img src="images/cupcakes.jpeg" class="card-img-top" alt="Cupcakes">
          <div class="card-body">
            <h4 class="fw-bold" style="color: #6f4e37;">Cupcakes</h4>
            <a href="cupcakes.php" class="btn btn-shop mt-2">Shop Now</a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card h-100 category-card shadow-sm">
          <img src="images/tea.jpg" class="card-img-top" alt="Tea">
          <div class="card-body">
            <h4 class="fw-bold" style="color: #6f4e37;">Tea</h4>
            <a href="tea.php" class="btn btn-shop mt-2">Shop Now</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<section class="py-5 bg-white">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold" style="color: #3d2b1f;">Trending Now</h2>
      <p class="text-muted">Handpicked favorites from our Serandib collection</p>
    </div>

    <div class="row g-4">
      <?php
      // Database එකෙන් බඩු 4ක් අරන් display කරනවා
      $query = "SELECT * FROM products LIMIT 4";
      $result = $conn->query($query);

      if ($result && $result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
      ?>
      <div class="col-md-3">
        <div class="card h-100 category-card shadow-sm border-0">
          <img src="images/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>" style="height: 200px; object-fit: cover;">
          <div class="card-body text-center">
            <h5 class="fw-bold" style="color: #6f4e37;"><?php echo $row['name']; ?></h5>
            <p class="text-success fw-semibold">$<?php echo number_format($row['price'], 2); ?></p>
            <a href="product_details.php?id=<?php echo $row['id']; ?>" class="btn btn-shop btn-sm">View Details</a>
          </div>
        </div>
      </div>
      <?php
          }
      } else {
          echo "<div class='col-12 text-center'><p class='text-muted'>Check back soon for new arrivals!</p></div>";
      }
      ?>
    </div>
  </div>
</section>

<footer class="py-4 bg-dark text-light text-center">
  <p class="mb-0">&copy; 2026 Serandib Twist. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>