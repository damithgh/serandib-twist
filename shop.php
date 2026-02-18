<?php 
session_start();
include 'db.php'; 


$cat = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title><?php echo $cat; ?> - Serandib Twist</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="images/logo.png" alt="Logo" height="80">
    </a>
    <div class="collapse navbar-collapse" id="navContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown">Shop</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="shop.php?category=Spices">Sri Lankan Spices</a></li>
            <li><a class="dropdown-item" href="shop.php?category=Cupcakes">Cupcakes</a></li>
            <li><a class="dropdown-item" href="shop.php?category=Coffee">Coffee</a></li>
            <li><a class="dropdown-item" href="shop.php?category=Tea">Tea</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<section class="py-5">
  <div class="container">
    <h2 class="section-title fw-bold text-center w-100 mb-5"><?php echo $cat; ?> Collection</h2>
    
    <div class="row g-4">
      <?php
      
      $products = $conn->query("SELECT * FROM products WHERE category = '$cat'");
      
      if($products && $products->num_rows > 0):
        while($item = $products->fetch_assoc()):
      ?>
      <div class="col-md-3">
        <div class="card h-100 shadow-sm border-0">
          <img src="images/<?php echo $item['image']; ?>" class="card-img-top" alt="<?php echo $item['name']; ?>">
          <div class="card-body text-center">
            <h5 class="fw-bold"><?php echo $item['name']; ?></h5>
            <p class="text-success fw-bold">$<?php echo number_format($item['price'], 2); ?></p>
            
            <a href="product_details.php?id=<?php echo $item['id']; ?>" class="btn btn-add-cart w-100 mb-2">View Details</a>
            
            <button onclick="addToCart('<?php echo $item['name']; ?>')" class="btn btn-outline-dark btn-sm rounded-pill w-100">
                <i class="fas fa-cart-plus"></i> Add to Cart
            </button>
          </div>
        </div>
      </div>
      <?php endwhile; else: ?>
        <div class="col-12 text-center py-5">
            <p class="text-muted">No products found in <?php echo $cat; ?> category.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<script>
function addToCart(name) {
    alert(name + " has been added to your cart!");
}
</script>

<footer class="py-4 bg-dark text-light text-center">
    <p class="mb-0">&copy; 2026 Serandib Twist. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>