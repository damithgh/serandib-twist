<?php
session_start();
include 'db.php';


if (!isset($_GET['id'])) {
    die("Invalid Invoice ID");
}

$order_id = $_GET['id'];
$order_query = $conn->query("SELECT * FROM orders WHERE id = $order_id");
$order = $order_query->fetch_assoc();

if (!$order) {
    die("Order not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - Serandib Twist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .invoice-box {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #eee;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            color: #555;
        }
        .invoice-header { border-bottom: 2px solid #6f4e37; padding-bottom: 20px; margin-bottom: 20px; }
        .invoice-title { color: #6f4e37; font-weight: bold; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>

<div class="invoice-box">
    <div class="invoice-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="invoice-title mb-0">SERANDIB TWIST</h2>
            <p class="mb-0">Authentic Ceylonese Spices & Delights</p>
        </div>
        <div class="text-end">
            <h4 class="mb-0">INVOICE</h4>
            <small>Order #<?php echo $order['id']; ?></small>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-6">
            <strong>Billed To:</strong><br>
            <?php echo $order['customer_name']; ?><br>
            <?php echo $order['email']; ?><br>
            <?php echo $order['phone']; ?>
        </div>
        <div class="col-6 text-end">
            <strong>Order Date:</strong><br>
            <?php echo date('F j, Y, g:i a', strtotime($order['order_date'])); ?><br>
            <strong>Address:</strong><br>
            <?php echo $order['address']; ?>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Description</th>
                <th class="text-end">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Total (Including Delivery)</td>
                <td class="text-end fw-bold">$<?php echo number_format($order['total_amount'], 2); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="text-center mt-5">
        <p class="fst-italic text-muted">Thank you for shopping with Serandib Twist! Come again.</p>
        <div class="no-print mt-4">
            <button onclick="window.print()" class="btn btn-primary me-2">Print Invoice</button>
            <a href="index.php" class="btn btn-secondary">Back to Store</a>
        </div>
    </div>
</div>

</body>
</html>