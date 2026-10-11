<?php
/**
 * index.php — Main landing page.
 * Loads all modular sections using PHP include.
 */
require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include __DIR__ . '/phpfiles/header.php'; ?>
</head>
<body>
  <?php include __DIR__ . '/phpfiles/navbar.php'; ?>
  <?php include __DIR__ . '/phpfiles/header2.php'; ?>
  <?php include __DIR__ . '/phpfiles/section.php'; ?>
  <?php include __DIR__ . '/phpfiles/footer.php'; ?>
</body>
</html>
