<?php
require_once '../config/db_connection.php';

if (isset($_POST['login'])) {
    $valid_data = login_user($_POST['username'], $_POST['password'], $pdo);

    if ($valid_data === 1) {
        header("Location: ../pages/homepage.php");
        exit;
    } else {
        header("Location: ../pages/login.php");
        $_SESSION['flash_msg']['type'] = 'danger';
        $_SESSION['flash_msg']['text'] = 'Невалидно потребителко име или парола.';
        exit;
    }
}

function login_user($username, $password, $pdo) {
    $valid_data = validate_login_input($username, $password);
    if ($valid_data !== 1) {
        return $valid_data; 
    }

    $user = get_user_by_username($username, $pdo);

    if ($user && password_verify($password, $user['password'])) {
        start_user_session($user['id'], $user['username']);
        return 1; 
    }

    return 0;
}

function validate_login_input($username, $password) {
    if (empty($username) || empty($password)) {
        return 0; 
    }
    return 1;
}

function get_user_by_username($username, $pdo) {
    $sql = "SELECT id, username, password FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user ?: null;
}

function start_user_session($user_id, $username) {
    session_start();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
}
?>
