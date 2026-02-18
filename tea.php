<?php 
session_start(); 
include 'db.php'; 

$sql = "SELECT * FROM products WHERE category = 'Tea'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> 
    <title>Ceylon Tea - Serandib Twist</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
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
          <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-bs-toggle="dropdown">Shop</a>
          <ul class="dropdown-menu shadow border-0">
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

<section class="py-5" style="background-color: #fdfaf5;">
  <div class="container">
    
    <h1 class="text-center mb-2" style="color: #3d2b1f; font-family: 'Playfair Display', serif;">Serandib Twist Tea</h1>
    <p class="text-center mb-5 text-muted">100% Natural & Fresh from Sri Lanka</p>
    
    <div class="row g-4 justify-content-center">
      <?php 
      if ($result && $result->num_rows > 0) { 
          while($row = $result->fetch_assoc()) { 
      ?>
          <div class="col-md-4 mb-4">
              <div class="card h-100 border-0 shadow-sm text-center p-3" style="border-radius: 20px;">
                  <img src="images/<?php echo $row['image']; ?>" class="card-img-top mx-auto" alt="<?php echo $row['name']; ?>" style="height: 200px; object-fit: cover; border-radius: 15px;">
                  
                  <div class="card-body d-flex flex-column">
                      <h4 class="fw-bold mb-2" style="color: #6f4e37;"><?php echo $row['name']; ?></h4>
                      <p class="text-muted small"><?php echo $row['description']; ?></p>
                      <h5 class="fw-bold mb-3">$ <?php echo number_format($row['price'], 2); ?></h5>
                      
                      <form action="cart.php" method="POST">
                          <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                          <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                          <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                          
                          <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                              <label class="small fw-bold">Qty:</label>
                              <input type="number" name="quantity" class="form-control form-control-sm text-center" value="1" min="1" style="width: 65px; border-radius: 8px;">
                          </div>
                          
                          <div class="d-grid gap-2 mt-auto">
                              <button type="submit" name="add_to_cart" class="btn btn-dark rounded-pill py-2 fw-bold text-white">Add to Cart</button>
                              <a href="product_details.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-dark rounded-pill py-2 small">Explore Product</a>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      <?php 
          } 
      } else { 
          echo "<div class='col-12 text-center'><p>No products found.</p></div>";
      } 
      ?>
    </div>
  </div>
</section>

<footer class="py-4 text-center bg-dark text-white">
  <p class="mb-0">&copy; 2026 Serandib Twist. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>