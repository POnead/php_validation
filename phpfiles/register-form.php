<section class="form-side">
      <form class="card" id="registerForm" action="register.php" method="post" novalidate>
        <h2>Create Account</h2>

        <?php if ($errors !== ''): ?>
          <div class="alert-error"><?= e($errors) ?></div>
        <?php endif; ?>

        <?php if ($success !== ''): ?>
          <div class="alert-success"><?= $success ?></div>
        <?php endif; ?>

        <div class="field">
          <input type="text" id="name" name="name" placeholder="Full Name"
                 autocomplete="name" value="<?= e($name) ?>">
        </div>

        <div class="field">
          <input type="email" id="email" name="email" placeholder="Email Address"
                 autocomplete="email" value="<?= e($email) ?>">
        </div>

        <div class="field">
          <input type="password" id="password" name="password" placeholder="Password"
                 autocomplete="new-password">
          <ul class="hint" id="passwordHint">
            <li id="hintLength">At least 8 characters</li>
            <li id="hintSpecial">At least 1 special character (! @ # $ % &amp; *)</li>
          </ul>
        </div>

        <div class="field">
          <input type="password" id="confirm" name="confirm" placeholder="Confirm Password"
                 autocomplete="new-password">
        </div>

        <button class="btn" type="submit">Register</button>

        <p class="links">Already have an account? <a href="login.php">Log In</a></p>
      </form>
    </section>

    <script>
      // Progressive enhancement only — real validation is done in PHP
      const SPECIAL_CHARS = /[!@#$%^&*()_+\-=\[\]{};':",.<>/?`~\\]/;

      function checkPasswordHint() {
        const value = document.getElementById('password').value;
        document.getElementById('hintLength').classList.toggle('met', value.length >= 8);
        document.getElementById('hintSpecial').classList.toggle('met', SPECIAL_CHARS.test(value));
      }

      document.getElementById('password').addEventListener('input', checkPasswordHint);
      checkPasswordHint();
    </script>
