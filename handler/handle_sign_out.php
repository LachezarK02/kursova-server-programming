<?php

$_SESSION = [];

session_destroy();

header("Location: ../pages/login.php");
exit;
