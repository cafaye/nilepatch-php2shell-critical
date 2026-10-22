# php2shell-critical

A PHP app running on EOL PHP 7.4 with multiple php2shell risk factors.

## Vulnerability

This app runs on PHP 7.4 (EOL — no official fix for php2shell):
- CVE-2026-109618: Upload-progress unserializer use-after-free → RCE + memory disclosure
- CVE-2026-109619: Fatal-error backtrace use-after-free + OPcache type confusion → RCE

## Risk factors

1. **File upload endpoint** (`upload.php`) — triggers multipart/form-data, the exact request type that activates the vulnerability
2. **Session-based auth** — session tokens can be leaked via memory disclosure
3. **Hardcoded sensitive data** (config.php) — passwords, API keys, session secrets in source code
4. **EOL PHP 7.4** — no official patch available
5. **No mitigations** — no WAF, no PHP settings, no multipart blocking

## Expected fix

Since PHP 7.4 is EOL (no official fix), the agent must apply mitigations:
1. Block multipart/form-data in the web server (Apache .htaccess or config)
2. Disable session upload progress (`session.upload_progress.enabled = 0`)
3. Set `memory_limit = -1`
4. Move sensitive data (DB_PASS, API_KEY, SESSION_SECRET) to environment variables
5. Add input validation on the upload endpoint

## Tests

```sh
php tests/test_basic.php
```

Note: Tests verify the CURRENT (vulnerable) state. After the fix, some tests will break and need updating:
- test 3 (session upload progress enabled) → should be disabled after fix
- test 4 (memory limit not -1) → should be -1 after fix
- test 2 (config loads with hardcoded creds) → should use env vars after fix
