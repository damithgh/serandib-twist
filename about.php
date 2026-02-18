<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>About Us - Serandib Twist</title>
    <style>
        /* Image Style & Hover Zoom */
        .about-img-box {
            width: 800px; /* පින්තූරය පොඩියට තියාගන්න */
            margin: 0 auto 30px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .about-img-box img {
            width: 100%;
            transition: transform 0.5s ease;
        }
        .about-img-box:hover img {
            transform: scale(1.1);
        }
        
        /* Text alignment and font */
        .content-section {
            max-width: 800px; /* Text එක දෙපැත්තට විසිරෙන්නේ නැතුව මැදට වෙන්න */
            margin: 0 auto;
            text-align: center;
        }
        .about-title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 25px;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="images/logo.png" height="70"></a>
    <div class="collapse navbar-collapse" id="navContent">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link active" href="about.php">About Us</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Shop</a>
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
            🛒 Cart
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
            </span>
          </a>
      </ul>
      <a class="btn btn-outline-warning rounded-pill px-4" href="login.php">Admin</a>
    </div>
  </div>
</nav>

<div class="container py-5">
    
    <div class="content-section">
        <h2 class="about-title">The Birth of Serandib Twist</h2>
        
        <div class="about-img-box">
            <img src="images/about.jpg" alt="About Us">
        </div>
        
        <div class="px-3">
            <p class="text-muted" style="line-height: 1.8;">
                <strong>Founded on January 20, 2026</strong>, Serandib Twist was born from a singular vision to bridge the gap between the lush, sun-drenched landscapes of Sri Lanka and the discerning palates of the modern world. Our journey began with a commitment to authenticity, bringing a contemporary "twist" to the ancient spice traditions of Serandib.
            </p>
            <p class="text-muted" style="line-height: 1.8;">
                At the heart of our brand is an uncompromising promise of purity. We offer 100% natural and fresh products, sourced directly from the soil where they thrive. Serandib Twist is more than a marketplace; it is an invitation to experience the spirit of the island perfected for the global kitchen.
            </p>
        </div>

        <hr class="my-5">

        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <p class="mb-0 fw-bold"><i class="bi bi-geo-alt-fill text-danger"></i> Address</p>
                <p class="text-muted small">Aleksanterinkatu 15, Helsinki</p>
            </div>
            <div class="col-md-4">
                <p class="mb-0 fw-bold"><i class="bi bi-telephone-fill text-success"></i> Call Us</p>
                <p class="text-muted small">+358 9 6123 4567</p>
            </div>
            <div class="col-md-4">
                <p class="mb-0 fw-bold"><i class="bi bi-envelope-fill text-primary"></i> Email</p>
                <p class="small"><a href="mailto:serandibtwist@hotmail.com" class="text-decoration-none">serandib@hotmail.com</a></p>
            </div>
        </div>
    </div>
</div>

<footer class="py-4 bg-dark text-light text-center">
    <p class="mb-0 small">&copy; 2026 Serandib Twist. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>