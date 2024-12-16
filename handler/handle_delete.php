<?php

require_once '../config/db_connection.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function deleteEmployee($pdo) {
    if (isset($_POST['delete'])) {
        $employeeId = $_POST['employee_id'];
        $userId = $_SESSION['user_id'];
        
        $sql = "DELETE FROM employees WHERE id = :employee_id AND user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':employee_id' => $employeeId, ':user_id' => $userId]);

        header("Location: ../pages/homepage.php");
        exit;
    }
}



deleteEmployee($pdo);
