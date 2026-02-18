<?php
session_start();

// login check
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

// getting orders with payment details using a JOIN
$sql = "SELECT orders.id, orders.customer_name, orders.email, orders.phone, orders.address, 
               orders.total_amount, orders.order_date, 
               payments.payment_method, payments.status 
        FROM orders 
        LEFT JOIN payments ON orders.id = payments.order_id 
        ORDER BY orders.id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Customer Orders - Serandib Twist</title>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Customer Order History</h2>
        <div>
            <a href="admin.php" class="btn btn-secondary me-2">Back to Dashboard</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Details</th>
                            <th>Address</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) { 
                        ?>
                        <tr>
                            <td class="fw-bold">#<?php echo $row['id']; ?></td>
                            <td>
                                <strong><?php echo $row['customer_name']; ?></strong><br>
                                <small class="text-muted"><?php echo $row['email']; ?></small><br>
                                <small class="text-muted"><?php echo $row['phone']; ?></small>
                            </td>
                            <td><small><?php echo $row['address']; ?></small></td>
                            <td class="fw-bold text-success">$<?php echo number_format($row['total_amount'], 2); ?></td>
                            <td>
                                <span class="badge bg-info text-dark"><?php echo $row['payment_method'] ?? 'N/A'; ?></span>
                            </td>
                            <td>
                                <span class="badge <?php echo ($row['status'] == 'Success') ? 'bg-success' : 'bg-warning'; ?>">
                                    <?php echo $row['status'] ?? 'Pending'; ?>
                                </span>
                            </td>
                            <td><small><?php echo $row['order_date']; ?></small></td>
                        </tr>
                        <?php 
                            } 
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No orders found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>