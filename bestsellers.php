<?php 
// get database connection from here.
include 'db.php'; 


$sql = "SELECT * FROM products LIMIT 3"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Best Sellers - Serandib Twist</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  /* --- Ultra Smooth & Slow Flowing Dropdown --- */
  .navbar-nav .dropdown-menu {
    display: block !important;
    opacity: 0;
    visibility: hidden;
    
    transform: translateY(-30px) scaleY(0);
    transform-origin: top;
    
    
    transition: all 0.9s cubic-bezier(0.23, 1, 0.32, 1); 
    
    border: none;
    border-top: 3px solid #f1c40f; 
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    border-radius: 0 0 10px 10px;
    padding: 10px 0;
  }

  
  .nav-item.dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scaleY(1);
  }

  
  .dropdown-item {
    transition: all 0.6s ease-out;
    transform: translateY(-10px);
    opacity: 0;
    padding: 10px 20px;
  }

  .nav-item.dropdown:hover .dropdown-item {
    transform: translateY(0);
    opacity: 1;
    transition-delay: 0.2s; 
  }

  .dropdown-item:hover {
    background-color: #f4f1ee;
    color: #6f4e37 !important;
    padding-left: 30px; 
    transition: all 0.3s ease;
  }

  
  .carousel-item img {
    transition: transform 6s ease-in-out !important;
  }
  .carousel-item.active img {
    transform: scale(1.15);
  }
  .carousel-fade .carousel-item {
    transition-duration: 2.0s !important;
  }
  .card-img-top {
    height: 200px;
    object-fit: cover;
  }
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

<section class="py-5 text-center bg-light">
  <div class="container">
    <h1 class="fw-bold display-4">Best Sellers</h1>
    <p class="text-muted lead">Customer favorites loved for quality, freshness, and authentic flavor.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4" id="bestseller-container">
      <?php
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              ?>
              <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0" onmouseover="highlightCard(this)" onmouseout="normalCard(this)">
                  <span class="badge bg-danger position-absolute top-0 start-0 m-3">Best Seller</span>
                  <img src="images/<?php echo $row['image']; ?>" class="card-img-top" alt="Product">
                  <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p class="card-text text-muted"><?php echo $row['description']; ?></p>
                    <p class="fw-bold h5">$. <?php echo $row['price']; ?></p>
                    <button class="btn btn-outline-dark mt-auto" onclick="viewMessage('<?php echo $row['name']; ?>')">View Details</button>
                  </div>
                </div>
              </div>
              <?php
          }
      } else {
          echo "<p class='text-center'>No products found in database.</p>";
      }
      ?>
    </div>
  </div>
</section>

<footer class="py-4 bg-dark text-light text-center">
  <p class="mb-0">&copy; 2026 Serandib Twist. All Rights Reserved.</p>
</footer>

<script>
function highlightCard(element) {
    element.style.boxShadow = "0 10px 30px rgba(0,0,0,0.3)";
}

function normalCard(element) {
    element.style.boxShadow = "none";
}

function viewMessage(productName) {
    alert("You clicked on " + productName + ". Details coming soon!");
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>