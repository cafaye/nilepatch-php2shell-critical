<?php
// VULNERABLE: hardcoded sensitive data that could be leaked via memory disclosure
define('DB_HOST', 'localhost');
define('DB_USER', 'admin');
define('DB_PASS', 'SuperSecret123!');
define('API_KEY', 'sk-live-abc123def456ghi789');
define('SESSION_SECRET', 'session-secret-key-xyz');
?>
