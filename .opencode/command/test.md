---
description: Run the checks currently available for this PHP/WordPress plugin
---

# Test AZWP Mailer

Run from the repository root. Do not install tools, change files, or auto-fix failures.

1. Confirm `php` is available. If it is not, report that the check was skipped and stop.
2. Run:

   ```bash
   php -l azwp-mailer/azwp-mailer.php
   ```

3. Stop immediately on failure and report the command and error output.
4. On success, report that PHP syntax passed and that this repository currently has no PHPUnit, Composer, PHPCS, PHPStan, or application Node test suite.

Use `$ARGUMENTS` only as additional user-approved scope. Never infer or install a test framework.
