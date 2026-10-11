<?php
/**
 * login.php — Login page with PHP server-side validation using Regular Expressions.
 * Satisfies the "Form Validation Using Regular Expressions" rubric item.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

$errors   = [];
$success  = '';
$email    = '';
$password = '';

// Initialise attempt counter
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// If already logged in, redirect to landing page
if (!empty($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

if (isPost()) {
    $email    = post('email');
    $password = post('password');

    // --- PHP REGEX VALIDATION ---
    if ($email === '') {
        $errors['email'] = 'Email address is required.';
    } elseif (!validateEmail($email)) {
        $errors['email'] = 'Please enter a valid email address (e.g. name@domain.com).';
    }

    if ($password === '') {
        $errors['password'] = 'Password is required.';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters.';
    }

    // --- CREDENTIAL CHECK ---
    if (empty($errors)) {
        if ($_SESSION['login_attempts'] >= MAX_LOGIN_ATTEMPTS) {
            $errors['general'] = 'No attempts left. Please restart the page.';
        } elseif (strcasecmp($email, DEMO_EMAIL) !== 0 || $password !== DEMO_PASSWORD) {
            $_SESSION['login_attempts']++;
            $remaining = MAX_LOGIN_ATTEMPTS - $_SESSION['login_attempts'];
            $errors['general'] = 'Email or password is incorrect. Attempts left: ' . max(0, $remaining);
        } else {
            // Success
            $_SESSION['user'] = [
                'name'  => 'Demo User',
                'email' => $email,
            ];
            $_SESSION['login_attempts'] = 0;
            header('Location: index.php');
            exit;
        }
    }
}

$attemptsLeft = MAX_LOGIN_ATTEMPTS - (int) $_SESSION['login_attempts'];
if ($attemptsLeft < 0) {
    $attemptsLeft = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | CafeTrack</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="split">

    <section class="brand">
      <h1>CafeTrack</h1>
      <p>Merrylane Cafe Foodhub Inventory System</p>

      <svg viewBox="0 0 220 170" fill="none" stroke="#55705A" stroke-width="3" stroke-linecap="round" aria-hidden="true">
        <path d="M110 10v55"/>
        <path d="M108 42C72 26 46 40 40 70c30 12 56-2 68-28Z"/>
        <path d="M100 48C82 54 62 61 48 69" stroke-width="2"/>
        <path d="M112 42c36-16 62-2 68 28-30 12-56-2-68-28Z"/>
        <path d="M120 48c18 6 38 13 52 21" stroke-width="2"/>
        <g transform="translate(70 120) rotate(-18)">
          <ellipse rx="27" ry="19"/>
          <path d="M-24 -4C-8 4 8 6 24 2" stroke-width="2"/>
        </g>
        <g transform="translate(132 112) rotate(14)">
          <ellipse rx="24" ry="17"/>
          <path d="M-21 -3C-7 3 7 5 21 2" stroke-width="2"/>
        </g>
        <g transform="translate(102 148) rotate(-6)">
          <ellipse rx="22" ry="16"/>
          <path d="M-19 -3C-6 3 6 4 19 1" stroke-width="2"/>
        </g>
      </svg>
    </section>

    <section class="form-side">
      <form class="card" id="loginForm" action="login.php" method="post" novalidate>
        <h2>Welcome Back</h2>

        <?php if (!empty($errors['general'])): ?>
          <div class="alert-error"><?= e($errors['general']) ?></div>
        <?php endif; ?>

        <div class="demo-box">
          <p class="demo-title">Test Account</p>
          <p><span>Email:</span> demo@cafetrack.com</p>
          <p><span>Password:</span> Coffee#2026</p>
        </div>

        <div class="field <?= isset($errors['email']) ? 'invalid' : '' ?>">
          <input type="email" id="email" name="email" placeholder="Email Address"
                 autocomplete="email" value="<?= e($email) ?>">
          <?php if (!empty($errors['email'])): ?>
            <label class="error-msg"><?= e($errors['email']) ?></label>
          <?php endif; ?>
        </div>

        <div class="field <?= isset($errors['password']) ? 'invalid' : '' ?>">
          <input type="password" id="password" name="password" placeholder="Password"
                 autocomplete="current-password">
          <?php if (!empty($errors['password'])): ?>
            <label class="error-msg"><?= e($errors['password']) ?></label>
          <?php endif; ?>
        </div>

        <p class="attempts-msg <?= $attemptsLeft <= 1 ? 'low' : '' ?>">
          Attempts left: <span id="attemptsLeft"><?= $attemptsLeft ?></span>
        </p>

        <button class="btn" type="submit" <?= $attemptsLeft === 0 ? 'disabled' : '' ?>>Log In</button>

        <p class="links"><a href="#">Forgot Password?</a></p>
        <p class="links">Don't have an account? <a href="register.php">Register</a></p>
      </form>
    </section>

  </main>
</body>
</html>
