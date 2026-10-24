<?php
// Sensitive values are sourced from environment variables (no hardcoded secrets).
define('DB_HOST', 'localhost');
define('DB_USER', 'admin');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : '');
define('API_KEY', getenv('API_KEY') !== false ? getenv('API_KEY') : '');
define('SESSION_SECRET', getenv('SESSION_SECRET') !== false ? getenv('SESSION_SECRET') : '');

// Mitigations for php2shell (CVE-2026-109618, CVE-2026-109619)
ini_set('memory_limit', '-1');
ini_set('session.upload_progress.enabled', '0');
?>