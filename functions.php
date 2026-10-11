<?php
// functions.php — regex validation helpers

function validateName($name) {
    return preg_match("/^[A-Za-z\s.'-]{2,50}$/", trim($name));
}

function validateEmail($email) {
    $email = trim($email);
    return preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)
        && filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password) {
    $lengthOk  = strlen($password) >= 8;
    $specialOk = preg_match("/[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]/", $password);
    return $lengthOk && $specialOk;
}

function validatePhone($phone) {
    return preg_match("/^(\+63|0)9\d{2}[- ]?\d{3}[- ]?\d{4}$/", trim($phone));
}

function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function isPost() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}
?>
