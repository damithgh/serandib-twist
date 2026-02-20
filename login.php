<?php
session_start();
require_once 'db.php'; 

//in here checking the correct user entering to the admin pannel
if(isset($_SESSION['loggedin'])) {
    header("Location: admin.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $user_input = $conn->real_escape_string($_POST['username']);
    $pass_input = $_POST['password'];

    // checking loging credential with database
    
    $sql = "SELECT * FROM admins WHERE username = '$user_input' AND password = '$pass_input'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user_input;
        header("Location: admin.php");
        exit;
    } else {
        
        $error = "Incorrect Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> // website working in mobile versions
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Login - Serandib Twist</title>
    <style>
        body { 
            background: #f4f1ee; 
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .card { border-radius: 15px; border: none; }
        .btn-coffee { background-color: #6f4e37; color: white; border-radius: 50px; }
        .btn-coffee:hover { background-color: #4b3621; color: white; }
    </style>
</head>
<body>
// logo placement
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="text-center mb-4">
                <a href="index.php">
                    <img src="images/logo.png" alt="Serandib Twist Logo" style="height: 100px; width: auto;">
                </a>
            </div>
                // logging form box
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold" style="color: #6f4e37; font-family: 'Playfair Display', serif;">Admin Login</h3>
                        <p class="text-muted small">Serandib Twist Management Portal</p>
                    </div>
                      //display error in username/p wrd
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger py-2 small text-center"><?php echo $error; ?></div>
                    <?php endif; ?>
                        // user name textbox
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control rounded-3" placeholder="Enter username" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control rounded-3" placeholder="Enter password" required>
                        </div>
                        <button type="submit" class="btn btn-coffee w-100 shadow-sm py-2">Login to Dashboard</button>
                        
                        <div class="text-center mt-4">
                            <a href="index.php" class="text-decoration-none text-muted small">← Back to Website</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

