<?php

if(empty($_SESSION['user_id'])) {
    header('Location: login.php');
}

require_once '../config/db_connection.php';

$id = $_POST['id'];
$query = "SELECT * FROM employees WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $id]);
$employee = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-5">
        <!-- Card for the Update Form -->
        <div class="card shadow-lg p-4 mx-auto" style="max-width: 600px;">
            <h2 class="text-center text-dark mb-4">Update Employee Form</h2>

            <!-- Employee Form -->
            <form action="../handler/handle_update.php" method="POST">
                <input type="hidden" name="employee_id" value="<?php echo $employee['id'] ?? '' ?>">

                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstname" value="<?php echo $employee['firstname'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastname" value="<?php echo $employee['lastname'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position" value="<?php echo $employee['position'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <input type="text" class="form-control" id="department" name="department" value="<?php echo $employee['department'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" class="form-control" id="salary" name="salary" value="<?php echo $employee['salary'] ?? '' ?>" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-dark" name="update">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
