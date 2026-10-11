<?php
// config.php — sessions, constants, demo credentials
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('DEMO_EMAIL', 'demo@cafetrack.com');
define('DEMO_PASSWORD', 'Coffee#2026');
define('MAX_LOGIN_ATTEMPTS', 3);
?>
