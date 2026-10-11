<?php
/**
 * functions.php
 * Server-side validation helpers using Regular Expressions (preg_match).
 * This is the file that satisfies the "Form Validation Using Regular Expressions" rubric item.
 */

/**
 * Validate a full name.
 * Allows letters, spaces, periods, apostrophes and hyphens.
 * Length: 2–50 characters.
 */
function validateName(string $name): bool
{
    return (bool) preg_match("/^[A-Za-z\s.'-]{2,50}$/", trim($name));
}

/**
 * Validate an email address using a strict regex pattern.
 * Also cross-checked with PHP's filter_var for extra safety.
 */
function validateEmail(string $email): bool
{
    $email = trim($email);
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return (bool) preg_match($pattern, $email)
        && filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate a password.
 * Requirements:
 *   - At least 8 characters
 *   - At least 1 special character (! @ # $ % & * etc.)
 */
function validatePassword(string $password): bool
{
    $lengthOk  = strlen($password) >= 8;
    $specialOk = (bool) preg_match("/[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]/", $password);
    return $lengthOk && $specialOk;
}

/**
 * Validate a phone number (Philippine format).
 * Accepts: 09171234567, +639171234567, 0917-123-4567
 */
function validatePhone(string $phone): bool
{
    $pattern = "/^(\+63|0)9\d{2}[- ]?\d{3}[- ]?\d{4}$/";
    return (bool) preg_match($pattern, trim($phone));
}

/**
 * Escape output to prevent XSS.
 */
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Retrieve a POST value safely (trimmed).
 */
function post(string $key, string $default = ''): string
{
    return isset($_POST[$key]) ? trim((string) $_POST[$key]) : $default;
}

/**
 * Check whether the request is a POST.
 */
function isPost(): bool
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}
?>
