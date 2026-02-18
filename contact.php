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
    <title>Contact Us - Serandib Twist</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap');
        
        body { background-color: #fdfaf5; font-family: 'Poppins', sans-serif; }
        .navbar { background-color: #6f4e37 !important; }
        
        .contact-header { 
            background: linear-gradient(rgba(111, 78, 55, 0.8), rgba(111, 78, 55, 0.8)), url('images/banner.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .contact-info-card {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
            background: white;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            height: 100%;
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background: #fdfaf5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: #6f4e37;
            font-size: 24px;
        }

        .btn-send {
            background-color: #6f4e37;
            color: white;
            border-radius: 50px;
            padding: 12px 30px;
            border: none;
        }
        .btn-send:hover { background-color: #4b3621; color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color:#6f4e37; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="images/logo.png" alt="Serandib Twist Logo" height="80">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Shop
          </a>
          <ul class="dropdown-menu shadow border-0" aria-labelledby="shopDropdown">
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
        </li>
      </ul>

      <div class="d-flex align-items-center gap-3">
        <form class="d-flex" action="search.php" method="GET">
          <input class="form-control me-2 rounded-pill" name="query" type="search" placeholder="Search products..." required>
          <button class="btn btn-outline-light rounded-pill" type="submit">Search</button>
        </form>
        <a class="nav-link text-warning fw-bold border border-warning px-3 py-1 rounded-pill" href="login.php">Admin</a>
      </div>
    </div>
  </div>
</nav>

<div class="contact-header">
    <div class="container">
        <h1 class="display-4 fw-bold" style="font-family: 'Playfair Display', serif;">Get In Touch</h1>
        <p class="lead">We'd love to hear from you. Reach out to us for any spice-related inquiries.</p>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="contact-info-card text-center">
                <div class="icon-box mx-auto">📍</div>
                <h5 class="fw-bold">Address</h5>
                <p class="text-muted">123 Spice Garden, Kandy Road,<br>Matale, Sri Lanka.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="contact-info-card text-center">
                <div class="icon-box mx-auto">📞</div>
                <h5 class="fw-bold">Phone</h5>
                <p class="text-muted">+94 77 123 4567<br>+94 11 222 3344</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="contact-info-card text-center">
                <div class="icon-box mx-auto">📧</div>
                <h5 class="fw-bold">Email</h5>
                <p class="text-muted">hello@serandibtwist.com<br>orders@serandibtwist.com</p>
            </div>
        </div>
    </div>

    <div class="row mt-5 g-5">
        <div class="col-md-6">
            <div class="bg-white p-4 rounded-4 shadow-sm">
                <h3 class="fw-bold mb-4" style="color: #6f4e37;">Send us a Message</h3>
                <form onsubmit="alert('Message Sent! We will get back to you soon.'); return false;">
                    <div class="mb-3">
                        <label class="form-label">Your Name</label>
                        <input type="text" class="form-control rounded-pill" placeholder="John Doe" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control rounded-pill" placeholder="john@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" class="form-control rounded-pill" placeholder="Order Inquiry" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea class="form-control rounded-4" rows="5" placeholder="Tell us more..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-send w-100">Send Message</button>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="rounded-4 overflow-hidden shadow-sm h-100" style="min-height: 400px;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126581.56586395537!2d80.560413!3d7.290571!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae3662d9a413e17%3A0xeda2a433619da2a!2sKandy!5e0!3m2!1sen!2slk!4v1700000000000!5m2!1sen!2slk" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>

<footer class="py-4 bg-dark text-light text-center">
    <p class="mb-0">&copy; 2026 Serandib Twist. All Rights Reserved.</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>