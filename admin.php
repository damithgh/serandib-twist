<?php
session_start();

// safety check for login
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

// process for adding a new product
if (isset($_POST['add_product'])) { //does it exist or is it not null
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $cat = $_POST['category'];
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $img_name = mysqli_real_escape_string($conn, $_POST['image']); 

    $q = "INSERT INTO products (name, price, category, description, image) 
          VALUES ('$name', '$price', '$cat', '$desc', '$img_name')";
    
    if (mysqli_query($conn, $q)) {
        echo "<script>alert('Done! Product Added.'); window.location='admin.php';</script>";
    }
}

// process for deleting a product
if (isset($_GET['delete'])) {
    $id_to_del = $_GET['delete'];
    $del_q = "DELETE FROM products WHERE id = $id_to_del";
    mysqli_query($conn, $del_q);
    header("Location: admin.php");
    exit;
}

// fetching all products to show in table
$get_products = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");

// summary data for cards
$res1 = mysqli_query($conn, "SELECT SUM(total_amount) AS total FROM orders");
$data1 = mysqli_fetch_assoc($res1);

$res2 = mysqli_query($conn, "SELECT COUNT(id) AS count FROM orders");
$data2 = mysqli_fetch_assoc($res2);

$res3 = mysqli_query($conn, "SELECT SUM(total_amount) AS total FROM orders WHERE DATE(order_date) = CURDATE()");
$data3 = mysqli_fetch_assoc($res3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Panel - Serandib Twist</title>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Admin Product Manager</h2>
        <div>
            <a href="view_orders.php" class="btn btn-info fw-bold shadow-sm me-2 text-white">View Customer Orders </a>
            <a href="index.php" class="btn btn-secondary me-2">View Site</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-primary text-white p-3">
                <div class="card-body text-center">
                    <h6 class="text-uppercase small fw-bold">Total Sales Revenue</h6>
                    <h2 class="fw-bold mb-0">$<?php echo number_format($data1['total'] ?? 0, 2); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white p-3">
                <div class="card-body text-center">
                    <h6 class="text-uppercase small fw-bold">Today's Sales</h6>
                    <h2 class="fw-bold mb-0">$<?php echo number_format($data3['total'] ?? 0, 2); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-dark text-white p-3">
                <div class="card-body text-center">
                    <h6 class="text-uppercase small fw-bold">Total Orders</h6>
                    <h2 class="fw-bold mb-0"><?php echo $data2['count']; ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4 text-center" style="background: white; border-radius: 15px;">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">Order Management</h4>
                    <p class="text-muted">Click the button below to view all customer orders, payment methods, and delivery details.</p>
                    <a href="view_orders.php" class="btn btn-lg btn-primary px-5 fw-bold shadow-sm" style="border-radius: 50px;">
                        View All Customer Orders 
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-5 border-0">
        <div class="card-body p-4">
            <h5 class="card-title mb-4">Add New Product</h5>
            <form method="POST" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Price ($)</label>
                    <input type="number" step="0.01" name="price" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select">
                        <option value="Coffee">Coffee</option>
                        <option value="Tea">Tea</option>
                        <option value="Cupcake">Cupcake</option>
                        <option value="Spices">Spices</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Image Filename</label>
                    <input type="text" name="image" class="form-control" placeholder="e.g. coffee.jpg" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="2"></textarea>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" name="add_product" class="btn btn-success px-5">Add Product</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h5 class="card-title mb-4 text-primary">Current Inventory</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($get_products)) { ?>
                        <tr>
                            <td>
                                <img src="images/<?php echo $row['image']; ?>" width="50" height="50" style="object-fit: cover;" class="rounded border">
                            </td>
                            <td><?php echo $row['id']; ?></td>
                            <td class="fw-bold"><?php echo $row['name']; ?></td>
                            <td><span class="badge bg-info text-dark"><?php echo $row['category']; ?></span></td>
                            <td>$<?php echo number_format($row['price'], 2); ?></td>
                            <td class="text-center">
                                <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="admin.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>

</html>



