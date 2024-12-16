<?php
$flash_msg = [];
if (isset($_SESSION['flash_msg'])) {
    $flash_msg = $_SESSION['flash_msg'];
    unset($_SESSION['flash_msg']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
            <div class="container-fluid">
                <a class="navbar-brand fs-4" href="#">Welcome</a>
                <div class="ms-auto">
                    <a href="register.php" class="btn btn-outline-light">Sign Up</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Login Form -->
    <div class="container position-relative">
        <?php
            if (!empty($flash_msg)) {
                echo '<div class=" alert alert-' . $flash_msg['type'] . ' col-md-6 mx-auto">' . $flash_msg['text'] . '</div>';
            }
        ?>
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login</h2>
                        <form action="../handler/handle_login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" class="form-control" placeholder="Enter your username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark w-50" name="login">Login</button>
                            </div>
                        </form>
                        <p class="text-center mt-3">
                            Don't have an account? <a href="register.php" class="text-decoration-none">Sign up here</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb4xkVvwP2vWFS2Q9EKb3/6EJkLZ9UwN76pGltF9w6UJ0Zr93" crossorigin="anonymous"></script>
</body>
</html>
