<?php
// Basic tests for the app — verify fixed (mitigated) state
require_once __DIR__ . '/../config.php';

// Test 1: Config uses environment variables (no hardcoded secrets)
assert(defined('DB_HOST'), "DB_HOST should be defined");
assert(defined('DB_PASS'), "DB_PASS should be defined");
assert(defined('API_KEY'), "API_KEY should be defined");
assert(defined('SESSION_SECRET'), "SESSION_SECRET should be defined");
assert(DB_PASS !== 'SuperSecret123!', "DB_PASS should not be hardcoded");
assert(API_KEY !== 'sk-live-abc123def456ghi789', "API_KEY should not be hardcoded");
assert(SESSION_SECRET !== 'session-secret-key-xyz', "SESSION_SECRET should not be hardcoded");
echo "Test 1 passed: Config uses environment variables\n";

// Test 2: Session upload progress is disabled
$progress = ini_get('session.upload_progress.enabled');
assert($progress == '0' || $progress === false || $progress === 'Off' || $progress === '' || $progress === 0, "Session upload progress should be disabled");
echo "Test 2 passed: Session upload progress disabled\n";

// Test 3: Memory limit is -1
$memLimit = ini_get('memory_limit');
assert($memLimit === '-1', "Memory limit should be -1");
echo "Test 3 passed: Memory limit is $memLimit\n";

// Test 4: Upload endpoint exists
assert(file_exists(__DIR__ . '/../upload.php'), "Upload endpoint should exist");
echo "Test 4 passed: Upload endpoint exists\n";

echo "All tests passed (fixed state)\n";
