<?php
// login-process.php — handles POST, regex validation, and credential check.

$errors = '';
$email  = '';

if (isPost()) {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // --- PHP REGEX VALIDATION ---
    if ($email === '') {
        $errors = 'Email address is required.';
    } elseif (!validateEmail($email)) {
        $errors = 'Please enter a valid email address (e.g. name@domain.com).';
    } elseif ($password === '') {
        $errors = 'Password is required.';
    } elseif (strlen($password) < 8) {
        $errors = 'Password must be at least 8 characters.';
    }
    // --- CREDENTIAL CHECK ---
    elseif (($_SESSION['login_attempts'] ?? 0) >= MAX_LOGIN_ATTEMPTS) {
        $errors = 'No attempts left. Please refresh the page.';
    } elseif (strcasecmp($email, DEMO_EMAIL) !== 0 || $password !== DEMO_PASSWORD) {
        $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
        $left   = MAX_LOGIN_ATTEMPTS - $_SESSION['login_attempts'];
        $errors = 'Email or password is incorrect. Attempts left: ' . max(0, $left);
    } else {
        $_SESSION['user'] = ['email' => $email];
        $_SESSION['login_attempts'] = 0;
        header('Location: index.php');
        exit;
    }
}

$attemptsLeft = MAX_LOGIN_ATTEMPTS - ($_SESSION['login_attempts'] ?? 0);
if ($attemptsLeft < 0) $attemptsLeft = 0;
?>
