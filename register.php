<?php
/**
 * register.php — Registration page with PHP server-side validation using Regular Expressions.
 * Satisfies the "Form Validation Using Regular Expressions" rubric item.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

$errors  = [];
$success = '';
$old     = ['name' => '', 'email' => ''];

if (isPost()) {
    $name     = post('name');
    $email    = post('email');
    $password = post('password');
    $confirm  = post('confirm');

    $old['name']  = $name;
    $old['email'] = $email;

    // --- PHP REGEX VALIDATION ---
    if ($name === '') {
        $errors['name'] = 'Full name is required.';
    } elseif (!validateName($name)) {
        $errors['name'] = 'Name must be 2–50 characters (letters, spaces, . \' - only).';
    }

    if ($email === '') {
        $errors['email'] = 'Email address is required.';
    } elseif (!validateEmail($email)) {
        $errors['email'] = 'Please enter a valid email address (e.g. name@domain.com).';
    }

    if ($password === '') {
        $errors['password'] = 'Password is required.';
    } elseif (!validatePassword($password)) {
        $errors['password'] = 'Password must be 8+ characters and include at least 1 special character (! @ # $ % & *).';
    }

    if ($confirm === '') {
        $errors['confirm'] = 'Please confirm your password.';
    } elseif ($confirm !== $password) {
        $errors['confirm'] = 'Passwords do not match.';
    }

    // --- SUCCESS ---
    if (empty($errors)) {
        // In a real app you would insert into a database here.
        // For this demo we simply store the new user in the session.
        $_SESSION['registered_user'] = [
            'name'  => $name,
            'email' => $email,
        ];
        $success = 'Registration successful! You may now <a href="login.php">log in</a>.';
        $old = ['name' => '', 'email' => ''];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | CafeTrack</title>
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
      <form class="card" id="registerForm" action="register.php" method="post" novalidate>
        <h2>Create Account</h2>

        <?php if ($success): ?>
          <div class="alert-success"><?= $success ?></div>
        <?php endif; ?>

        <div class="field <?= isset($errors['name']) ? 'invalid' : '' ?>">
          <input type="text" id="name" name="name" placeholder="Full Name"
                 autocomplete="name" value="<?= e($old['name']) ?>">
          <?php if (!empty($errors['name'])): ?>
            <label class="error-msg"><?= e($errors['name']) ?></label>
          <?php endif; ?>
        </div>

        <div class="field <?= isset($errors['email']) ? 'invalid' : '' ?>">
          <input type="email" id="email" name="email" placeholder="Email Address"
                 autocomplete="email" value="<?= e($old['email']) ?>">
          <?php if (!empty($errors['email'])): ?>
            <label class="error-msg"><?= e($errors['email']) ?></label>
          <?php endif; ?>
        </div>

        <div class="field <?= isset($errors['password']) ? 'invalid' : '' ?>">
          <input type="password" id="password" name="password" placeholder="Password"
                 autocomplete="new-password">
          <ul class="hint" id="passwordHint">
            <li id="hintLength">At least 8 characters</li>
            <li id="hintSpecial">At least 1 special character (! @ # $ % &amp; *)</li>
          </ul>
          <?php if (!empty($errors['password'])): ?>
            <label class="error-msg"><?= e($errors['password']) ?></label>
          <?php endif; ?>
        </div>

        <div class="field <?= isset($errors['confirm']) ? 'invalid' : '' ?>">
          <input type="password" id="confirm" name="confirm" placeholder="Confirm Password"
                 autocomplete="new-password">
          <?php if (!empty($errors['confirm'])): ?>
            <label class="error-msg"><?= e($errors['confirm']) ?></label>
          <?php endif; ?>
        </div>

        <button class="btn" type="submit">Register</button>

        <p class="links">Already have an account? <a href="login.php">Log In</a></p>
      </form>
    </section>

  </main>

  <script>
    // Progressive enhancement only — the real validation is done in PHP.
    const SPECIAL_CHARS = /[!@#$%^&*()_+\-=\[\]{};':",.<>/?`~\\]/;

    function checkPasswordHint() {
      const value = document.getElementById('password').value;
      document.getElementById('hintLength').classList.toggle('met', value.length >= 8);
      document.getElementById('hintSpecial').classList.toggle('met', SPECIAL_CHARS.test(value));
    }

    document.getElementById('password').addEventListener('input', checkPasswordHint);
    checkPasswordHint();
  </script>
</body>
</html>
