<?php
session_start();

// 1. කාර්ට් එකට බඩු එකතු කිරීම
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $qty = $_POST['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += $qty;
    } else {
        $_SESSION['cart'][$id] = array(
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'qty' => $qty
        );
    }
    header("Location: cart.php");
    exit();
}

// 2. බඩු කාර්ට් එකෙන් ඉවත් කිරීම
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]);
    }
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Serandib Twist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fdfaf5; font-family: 'Poppins', sans-serif; }
        .cart-header { background-color: #6f4e37; color: white; padding: 30px; border-radius: 15px 15px 0 0; }
        .card { border-radius: 15px; border: none; }
        .btn-checkout { background-color: #f1c40f; color: #3d2b1f; font-weight: bold; border: none; transition: 0.3s; }
        .btn-checkout:hover { background-color: #d4ac0d; transform: scale(1.02); }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="card shadow-lg">
        <div class="cart-header text-center">
            <h2 class="fw-bold mb-0">Your Shopping Cart 🛒</h2>
            <p class="mb-0">Serandib Twist - Purely Sri Lankan</p>
        </div>
        
        <div class="card-body p-4">
            <?php if (empty($_SESSION['cart'])): ?>
                <div class="text-center py-5">
                    <h4>Your cart is currently empty!</h4>
                    <p class="text-muted">Explore our authentic products to add them here.</p>
                    <a href="index.php" class="btn btn-dark px-4 rounded-pill mt-3">Start Shopping</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th class="text-center">Quantity</th>
                                <th>Total</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $grand_total = 0;
                            foreach ($_SESSION['cart'] as $item): 
                                $subtotal = $item['price'] * $item['qty'];
                                $grand_total += $subtotal;
                            ?>
                            <tr>
                                <td class="fw-bold"><?php echo htmlspecialchars($item['name']); ?></td>
                                <td>$<?php echo number_format($item['price'], 2); ?></td>
                                <td class="text-center">
                                    <span class="badge bg-secondary px-3 py-2"><?php echo $item['qty']; ?></span>
                                </td>
                                <td class="fw-bold text-success">$<?php echo number_format($subtotal, 2); ?></td>
                                <td class="text-center">
                                    <a href="cart.php?remove=<?php echo $item['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3">Remove</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="row mt-5 align-items-center">
                    <div class="col-md-6">
                        <a href="index.php" class="text-decoration-none text-muted fw-bold">← Continue Shopping</a>
                    </div>
                    <div class="col-md-6 text-end">
                        <h5 class="text-muted mb-1">Grand Total:</h5>
                        <h2 class="fw-bold text-dark mb-4">$<?php echo number_format($grand_total, 2); ?></h2>
                        <a href="checkout.php" class="btn btn-checkout btn-lg px-5 rounded-pill shadow">Proceed to Checkout</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>