<?php
// register-process.php — handles POST and regex validation.

$errors  = '';
$success = '';
$name    = '';
$email   = '';

if (isPost()) {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';

    // --- PHP REGEX VALIDATION ---
    if ($name === '') {
        $errors = 'Full name is required.';
    } elseif (!validateName($name)) {
        $errors = "Name must be 2-50 characters (letters, spaces, . ' - only).";
    } elseif ($email === '') {
        $errors = 'Email address is required.';
    } elseif (!validateEmail($email)) {
        $errors = 'Please enter a valid email address (e.g. name@domain.com).';
    } elseif ($password === '') {
        $errors = 'Password is required.';
    } elseif (!validatePassword($password)) {
        $errors = 'Password must be 8+ characters and include at least 1 special character (! @ # $ % & *).';
    } elseif ($confirm === '') {
        $errors = 'Please confirm your password.';
    } elseif ($confirm !== $password) {
        $errors = 'Passwords do not match.';
    } else {
        $_SESSION['registered_user'] = ['name' => $name, 'email' => $email];
        $success = 'Registration successful! You may now <a href="login.php">log in</a>.';
        $name  = '';
        $email = '';
    }
}
?>
