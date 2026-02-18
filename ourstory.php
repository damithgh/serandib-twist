<?php 


include 'db.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Our Story - Serandib Twist</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
 
  .navbar-nav .dropdown-menu {
    display: block !important;
    opacity: 0;
    visibility: hidden;
    
    transform: translateY(-30px) scaleY(0);
    transform-origin: top;
    
    
    transition: all 0.1s cubic-bezier(0.23, 1, 0.32, 1); 
    
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

  /* --- Carousel & Other Styles --- */
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
<section class="py-5 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center">

        <h1 class="bg-warning p-4 rounded-pill shadow-sm mb-5" style="font-size:36px; font-weight: bold; color: #4b3621;">
          The Journey of Ceylon Tea, Coffee & Spices
        </h1>

        <p class="fs-5 mb-5 story-card p-3 shadow-sm bg-white rounded">
          At <strong>Serandib Twist</strong>, we believe the <strong>best flavors come from nature</strong>.
          That’s why we travel across Sri Lanka to hand-pick the finest
          <strong>cinnamon, cardamom, coffee, tea, and spices</strong>.
        </p>

        <div id="storyCarousel" class="carousel slide mb-5 shadow p-3 mb-5 bg-white rounded" data-bs-ride="carousel">

          <div class="carousel-indicators">
            <?php for($i=0; $i<11; $i++): ?>
                <button type="button" data-bs-target="#storyCarousel" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo ($i==0)?'active':''; ?>"></button>
            <?php endfor; ?>
          </div>

          <div class="carousel-inner">
            <?php 
              $images = ["cin.jpg", "clove2.jpg", "coffee.jpg", "pepper.jpg", "nutmeg.jpg", "tea.jpg", "pepper2.jpg", "tea2.jpg", "nut2.jpg", "gin2.jpg", "coffee2.jpg"];
              foreach($images as $key => $img) {
                $active = ($key == 0) ? 'active' : '';
                echo "<div class='carousel-item $active'>
                        <img src='images/$img' class='d-block mx-auto w-75' alt='Ceylon Spice'>
                      </div>";
              }
            ?>
          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#storyCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#storyCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
          </button>
        </div>

        <div class="bg-white p-4 rounded shadow-sm">
            <p class="fs-5 mb-0" id="typingEffect">
              Our spices, coffee, and tea are carefully hand-picked in Sri Lanka,
              preserving nature’s finest flavors. Every cup and every pinch carries 
              the rich heritage, tradition, and warmth of our island.
            </p>
        </div>

      </div>
    </div>
  </div>
</section>

<footer class="py-4 bg-dark text-light text-center">
  <p class="mb-0">&copy; 2026 Serandib Twist. All Rights Reserved.</p>
</footer>

<script>
    
    window.onload = function() {
        const textElement = document.getElementById('typingEffect');
        textElement.style.color = '#6f4e37';
        textElement.style.fontWeight = 'bold';
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>