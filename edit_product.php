<?php
session_start();
include 'db.php'; 

// Admin login check.
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

// take the ID which coming from the URL query string.
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // data retrieve acording to the id.
    $result = $conn->query("SELECT * FROM products WHERE id = $id");
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found!";
        exit;
    }
} else {
    header("Location: admin.php");
    exit;
}

// Update.
if (isset($_POST['update_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);

    $sql = "UPDATE products SET name='$name', price='$price', category='$category', description='$description', image='$image' WHERE id=$id";
    
    if ($conn->query($sql)) {
        echo "<script>alert('Product Updated Successfully!'); window.location='admin.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Product - Serandib Twist</title>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <h3 class="mb-4 text-primary">Edit Product Details</h3>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price ($)</label>
                                <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-select">
                                    <option value="Coffee" <?php if($product['category'] == 'Coffee') echo 'selected'; ?>>Coffee</option>
                                    <option value="Tea" <?php if($product['category'] == 'Tea') echo 'selected'; ?>>Tea</option>
                                    <option value="Cupcake" <?php if($product['category'] == 'Cupcake') echo 'selected'; ?>>Cupcake</option>
                                    <option value="Spices" <?php if($product['category'] == 'Spices') echo 'selected'; ?>>Spices</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image Filename</label>
                            <input type="text" name="image" class="form-control" value="<?php echo $product['image']; ?>" required>
                            <small class="text-muted">Current: <?php echo $product['image']; ?></small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4"><?php echo $product['description']; ?></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="admin.php" class="btn btn-secondary">Cancel</a>
                            <button type="submit" name="update_product" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>