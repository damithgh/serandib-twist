<?php
session_start();
include 'db.php';

// cart check
if (empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit;
}

$total_price = 0;
foreach ($_SESSION['cart'] as $row) {
    $total_price += ($row['price'] * $row['qty']);
}

if (isset($_POST['place_order'])) {
    
    // variables naming in a simple way
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $pay_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

    // first insert into orders
    $sql1 = "INSERT INTO orders (customer_name, email, phone, address, total_amount) 
             VALUES ('$name', '$email', '$phone', '$address', '$total_price')";

    if (mysqli_query($conn, $sql1)) {
        
        $order_id = mysqli_insert_id($conn); // simple way to get last id

        // then insert into payments
        $sql2 = "INSERT INTO payments (order_id, amount, payment_method, status) 
                 VALUES ('$order_id', '$total_price', '$pay_method', 'Success')";
        
        mysqli_query($conn, $sql2);

        // email sending
        $to = $email;
        $subject = "Order Confirmed - Serandib Twist";
        $msg = "Order ID: #$order_id \nTotal: $total_price \nMethod: $pay_method";
        $headers = "From: sales@serandibtwist.com";

        @mail($to, $subject, $msg, $headers);

        unset($_SESSION['cart']);
        header("Location: success.php"); 
        exit;
    } else {
        echo "Error: " . mysqli_error($conn); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Serandib Twist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Keeping your original styling exactly as it was */
        body { background-color: #fdfaf5; font-family: 'Poppins', sans-serif; }
        .checkout-card, .summary-card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); background: white; }
        .btn-confirm { background-color: #27ae60; color: white; font-weight: bold; border-radius: 50px; padding: 12px; border: none; }
        .btn-confirm:hover { background-color: #219150; color: white; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row g-4">
        
        <div class="col-md-7">
            <div class="card checkout-card p-4">
                <h4 class="mb-4 fw-bold">Shipping Details</h4>
                <form method="POST" action="checkout.php">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Delivery Address</label>
                        <textarea name="address" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="Cash on Delivery">Cash on Delivery</option>
                            <option value="Card Payment">Card Payment</option> 
                            <option value="Online Payment">OnlinePayment</option>

                        </select>
                    </div>
                    <button type="submit" name="place_order" class="btn btn-confirm w-100 shadow-sm">Confirm Order & Pay</button>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card summary-card p-4">
                <h4 class="mb-3 fw-bold">Order Summary</h4>
                <hr>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $item): ?>
                            <tr>
                                <td>
                                    <strong><?php echo $item['name']; ?></strong><br>
                                    <small class="text-muted">Qty: <?php echo $item['qty']; ?></small>
                                </td>
                                <td class="text-end fw-bold text-dark">$<?php echo number_format($item['price'] * $item['qty'], 2); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-3 px-1">
                    <span class="h5 mb-0">Total to Pay</span>
                    <span class="h4 text-success fw-bold mb-0">$<?php echo number_format($total_price, 2); ?></span>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>