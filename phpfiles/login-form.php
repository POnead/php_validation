<section class="form-side">
      <form class="card" id="loginForm" action="login.php" method="post" novalidate>
        <h2>Welcome Back</h2>

        <?php if ($errors !== ''): ?>
          <div class="alert-error"><?= e($errors) ?></div>
        <?php endif; ?>

        <div class="demo-box">
          <p class="demo-title">Test Account</p>
          <p><span>Email:</span> demo@cafetrack.com</p>
          <p><span>Password:</span> Coffee#2026</p>
        </div>

        <div class="field">
          <input type="email" id="email" name="email" placeholder="Email Address"
                 autocomplete="email" value="<?= e($email) ?>">
        </div>

        <div class="field">
          <input type="password" id="password" name="password" placeholder="Password"
                 autocomplete="current-password">
        </div>

        <p class="attempts-msg <?= $attemptsLeft <= 1 ? 'low' : '' ?>">
          Attempts left: <span id="attemptsLeft"><?= $attemptsLeft ?></span>
        </p>

        <button class="btn" type="submit" <?= $attemptsLeft === 0 ? 'disabled' : '' ?>>Log In</button>

        <p class="links"><a href="#">Forgot Password?</a></p>
        <p class="links">Don't have an account? <a href="register.php">Register</a></p>
      </form>
    </section>
