<?php
include 'db.php';

$search_query = "";
if (isset($_GET['query'])) {
    $search_query = $_GET['query'];
}

//searching query in the database 
$sql = "SELECT * FROM products WHERE name LIKE '%$search_query%' OR category LIKE '%$search_query%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Search Results - Serandib Twist</title>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#6f4e37;">
    <div class="container">
        <a class="navbar-brand" href="index.php">Serandib Twist</a>
    </div>
</nav>

<div class="container py-5">
    <h2 class="mb-4">Search Results for: "<?php echo htmlspecialchars($search_query); ?>"</h2>

    <div class="row g-4">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="images/<?php echo $row['image']; ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                        <div class="card-body text-center">
                            <h5><?php echo $row['name']; ?></h5>
                            <p class="text-danger fw-bold">$ <?php echo number_format($row['price'], 2); ?></p>
                            <a href="#" class="btn btn-sm btn-dark">View Product</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <p class="lead text-muted">No products found matching your search.</p>
                <a href="index.php" class="btn btn-primary">Go Back Home</a>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>