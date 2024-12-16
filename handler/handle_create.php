<?php
require_once '../config/db_connection.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function createEmployee($pdo) {
    if (isset($_POST['add'])) {
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $position = $_POST['position'];
        $department = $_POST['department'];
        $salary = $_POST['salary'];
        
        if (!empty($firstName) && !empty($lastName) && !empty($position) && !empty($department) && !empty($salary)) {
            $userId = $_SESSION['user_id']; 
            
            $sql = "INSERT INTO employees (firstname, lastname, position, department, salary, user_id) 
                    VALUES (:firstname, :lastname, :position, :department, :salary, :user_id)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':firstname' => $firstName,
                ':lastname' => $lastName,
                ':position' => $position,
                ':department' => $department,
                ':salary' => $salary,
                ':user_id' => $userId
            ]);

            header("Location: ../pages/homepage.php");
            exit;
        }
    }
}


createEmployee($pdo);