<?php
require_once '../config/db_connection.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function getEmployees($pdo) {
    $employees = [];
    $userId = $_SESSION['user_id'];
    $sql = "SELECT * FROM employees WHERE user_id = :user_id";
    $params = [':user_id' => $userId];

    $sql = departmentFilter($sql, $params);
    $sql = salaryFilter($sql, $params);
    $sql = positionFilter($sql, $params);

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $employees[] = $row;
    }
    
    echo '
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Salary</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>';
    
    foreach ($employees as $employee) {
        echo '
            <tr>
                <td>' . $employee['id'] . '</td>
                <td>' . htmlspecialchars($employee['firstname']) . '</td>
                <td>' . htmlspecialchars($employee['lastname']) . '</td>
                <td>' . htmlspecialchars($employee['position']) . '</td>
                <td>' . htmlspecialchars($employee['department']) . '</td>
                <td>' . htmlspecialchars($employee['salary']) . '</td>
                <td>
                    <form method="POST" action="../pages/updatepage.php" class="d-inline-block">
                        <input type="hidden" name="id" value=" '. $employee['id'] .'">
                        <button type="submit" class="btn btn-sm btn-warning">Edit</button>
                    </form>     
                    <form method="POST" action="../handler/handle_delete.php" class="d-inline-block me-2">
                        <input type="hidden" name="employee_id" value="' . $employee['id'] . '">
                        <button type="submit" name="delete" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>';
    }

    echo '</tbody></table>';
}

function departmentFilter($sql, &$params) {
    if (isset($_POST['department_filter']) && !empty($_POST['department'])) {
        $department = $_POST['department'];
        $sql .= " AND department LIKE :department";
        $params[':department'] = '%' . $department . '%';
    }
    return $sql;
}

function salaryFilter($sql, &$params) {
    if (isset($_POST['salary_filter'])) {
        $startSalary = $_POST['start_salary'];
        $endSalary = $_POST['end_salary'];

        if (!empty($startSalary) && !empty($endSalary)) {
            $sql .= " AND salary BETWEEN :start_salary AND :end_salary";
            $params[':start_salary'] = $startSalary;
            $params[':end_salary'] = $endSalary;
        }
    }
    return $sql;
}

function positionFilter($sql, &$params) {
    if (isset($_POST['position_filter']) && !empty($_POST['position'])) {
        $position = $_POST['position'];
        $sql .= " AND position LIKE :position";
        $params[':position'] = '%' . $position . '%';
    }
    return $sql;
}
