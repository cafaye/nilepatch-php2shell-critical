<?php
// Basic tests for the app — verify current (vulnerable) state
require_once __DIR__ . '/../config.php';

// Test 1: Config loads with hardcoded credentials
assert(defined('DB_HOST'), "DB_HOST should be defined");
assert(defined('DB_PASS'), "DB_PASS should be defined");
assert(defined('API_KEY'), "API_KEY should be defined");
assert(defined('SESSION_SECRET'), "SESSION_SECRET should be defined");
echo "Test 1 passed: Config loads with credentials\n";

// Test 2: Session upload progress is enabled (vulnerable default)
$progress = ini_get('session.upload_progress.enabled');
assert($progress == '1' || $progress === true || $progress === 'On', "Session upload progress should be enabled by default");
echo "Test 2 passed: Session upload progress enabled\n";

// Test 3: Memory limit is not -1 (vulnerable default)
$memLimit = ini_get('memory_limit');
assert($memLimit !== '-1', "Memory limit should not be -1 by default");
echo "Test 3 passed: Memory limit is $memLimit\n";

// Test 4: Upload endpoint exists
assert(file_exists(__DIR__ . '/../upload.php'), "Upload endpoint should exist");
echo "Test 4 passed: Upload endpoint exists\n";

echo "All tests passed (vulnerable state)\n";
