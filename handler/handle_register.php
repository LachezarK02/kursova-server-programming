<?php
require_once '../config/db_connection.php';

if (isset($_POST['register'])) {
    $valid_data = register_user($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_confirm'], $pdo);

    if ($valid_data === 1) {
        header("Location: ../pages/register.php?valid_data=$valid_data");
        header("Refresh: 3; url=login.php");
        exit;
    } else {
        if ($valid_data === 0) {
            $_SESSION['flash_msg']['type'] = 'danger';
            $_SESSION['flash_msg']['text'] = 'Username or email already exists.';
        } elseif ($valid_data === 2) {
            $_SESSION['flash_msg']['type'] = 'danger';
            $_SESSION['flash_msg']['text'] = 'Passwords do not match.';
        } else {
            $_SESSION['flash_msg']['type'] = 'danger';
            $_SESSION['flash_msg']['text'] = 'An error occurred during registration. Please try again.';
        }
        header("Location: ../pages/register.php");
        exit;
    }
}

function register_user($username, $email, $password, $password_confirm, $pdo) {
    $valid_data = validate_password($password, $password_confirm);
    if ($valid_data !== 1) {
        return $valid_data; 
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    if (user_exists($username, $email, $pdo)) {
        return 0; 
    }
    return insert_user($username, $email, $hashed_password, $pdo) ? 1 : -1;
}

function validate_password($password, $password_confirm) {
    if ($password !== $password_confirm) {
        return 2;
    }
    return 1; 
}

function user_exists($username, $email, $pdo) {
    $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username, ':email' => $email]);
    return $stmt->rowCount() > 0;
}

function insert_user($username, $email, $hashed_password, $pdo) {
    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':username' => $username, ':email' => $email, ':password' => $hashed_password]);
}
?>
