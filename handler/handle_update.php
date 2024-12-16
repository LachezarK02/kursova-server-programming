<?php
require_once '../config/db_connection.php';

function updateEmployee($pdo) {
        echo($_POST);
    if (isset($_POST['update'])) {
        
        $employeeId = $_POST['employee_id'];
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $position = $_POST['position'];
        $department = $_POST['department'];
        $salary = $_POST['salary'];
        $userId = $_SESSION['user_id'];

        echo($_POST);

        if (!empty($firstName) && !empty($lastName) && !empty($position) && !empty($department) && !empty($salary)) {
            $sql = "UPDATE employees 
                    SET firstname = :firstname, lastname = :lastname, position = :position, 
                        department = :department, salary = :salary 
                    WHERE id = :employee_id AND user_id = :user_id";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':firstname' => $firstName,
                ':lastname' => $lastName,
                ':position' => $position,
                ':department' => $department,
                ':salary' => $salary,
                ':employee_id' => $employeeId,
                ':user_id' => $userId
            ]);

            header("Location: ../pages/homepage.php");
            exit;
        }
    }
}

updateEmployee($pdo);
?>
