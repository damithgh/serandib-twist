<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
} else {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $row['name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .p-img { border: 1px solid #ddd; padding: 10px; background: #fff; }
    </style>
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row">
        <div class="col-md-5">
            <img src="images/<?php echo $row['image']; ?>" class="img-fluid p-img">
        </div>
        <div class="col-md-7">
            <h1><?php echo $row['name']; ?></h1>
            <h3 class="text-primary">$<?php echo $row['price']; ?></h3>
            <p class="mt-4"><?php echo $row['description']; ?></p>
            
            <form action="cart.php" method="POST" class="mt-4">
                <input type="hidden" name="pid" value="<?php echo $row['id']; ?>">
                <div class="input-group" style="width: 150px;">
                    <span class="input-group-text">Qty</span>
                    <input type="number" name="qty" value="1" class="form-control">
                </div>
                <button class="btn btn-success mt-3">Add to Cart</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>