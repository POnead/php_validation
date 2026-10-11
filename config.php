<?php
/**
 * config.php
 * Central configuration and session bootstrap.
 * Include this at the top of every page that needs sessions or shared constants.
 */

// Start session only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Demo credentials (in a real app these would come from a database)
define('DEMO_EMAIL', 'demo@cafetrack.com');
define('DEMO_PASSWORD', 'Coffee#2026');
define('MAX_LOGIN_ATTEMPTS', 3);

// Site-wide constants
define('SITE_NAME', 'CafeTrack');
define('SITE_TAGLINE', 'Real-Time QR Inventory Tracking');
?>
