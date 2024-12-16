<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
            <ul class="navbar-nav">
                <li class="nav-item mx-2 my-2">
                    <a href="login.php" class="nav-link fs-4">Sign in</a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="container position-relative">
    <?php
    // Display flash message if exists
    if (isset($_SESSION['flash_msg'])) {
        echo '<div class="alert alert-' . $_SESSION['flash_msg']['type'] . ' col-md-6 mx-auto">' . $_SESSION['flash_msg']['text'] . '</div>';
        // Clear the message after displaying it
        unset($_SESSION['flash_msg']);
    }
    ?>
    
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="text-center mb-4">Register</h2>
                    <form action="../handler/handle_register.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" class="form-control" placeholder="Enter your username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Enter your email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirm Password</label>
                            <input type="password" id="password_confirm" class="form-control" placeholder="Confirm your password" name="password_confirm" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark w-50" name="register">Register</button>
                        </div>
                    </form>
                    <p class="text-center mt-3">
                        Already have an account? <a href="login.php" class="text-decoration-none">Login here</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

