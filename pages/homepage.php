<?php
    if(empty($_SESSION['user_id'])) {
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fs-4" href="#">Employee Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="../handler/handle_sign_out.php" class="btn btn-outline-light">Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-4">
        <h1 class="text-center mb-4">Manage Employees</h1>

        <!-- Filters Section -->
        <div class="card mb-4 shadow">
            <div class="card-body">
                <h4 class="card-title text-center mb-3">Filters</h4>

                <!-- Salary Filter -->
                <form method="POST" action="" class="row g-3">
                    <div class="col-md-3">
                        <label for="start_salary" class="form-label">Start Salary</label>
                        <input type="text" id="start_salary" name="start_salary" class="form-control" placeholder="Enter minimum salary">
                    </div>
                    <div class="col-md-3">
                        <label for="end_salary" class="form-label">End Salary</label>
                        <input type="text" id="end_salary" name="end_salary" class="form-control" placeholder="Enter maximum salary">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-dark w-100" name="salary_filter">Filter by Salary</button>
                    </div>
                </form>

                <!-- Department Filter -->
                <form method="POST" action="" class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" id="department" name="department" class="form-control" placeholder="Enter department name">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-dark w-100" name="department_filter">Filter by Department</button>
                    </div>
                </form>

                <!-- Position Filter -->
                <form method="POST" action="" class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" id="position" name="position" class="form-control" placeholder="Enter position title">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-dark w-100" name="position_filter">Filter by Position</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Employee Table -->
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title text-center mb-3">Employee List</h4>
                <?php
                    require_once '../config/db_connection.php';
                    require_once '../handler/handle_read.php';
                    getEmployees($pdo);
                ?>
                <div class="text-end">
                    <a href="createpage.php" class="btn btn-success">Add New Employee</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb4xkVvwP2vWFS2Q9EKb3/6EJkLZ9UwN76pGltF9w6UJ0Zr93" crossorigin="anonymous"></script>
</body>
</html>
