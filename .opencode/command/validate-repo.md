---
description: Validate the repository with available OpenCode, PHP, JSON, and Docker checks
---

# Validate Repository

Run from the repository root. This workflow is read-only: do not edit, generate, install, stage, or auto-fix anything.

Run these commands in order and stop on the first failure:

```bash
opencode debug config
php -l azwp-mailer/azwp-mailer.php
python3 -m json.tool .opencode/config/agent-metadata.json
docker compose --env-file .env.example config --quiet
```

Before each command, detect whether its executable is available. If unavailable, report the check as skipped and continue to the next available check. A command that exists but returns non-zero is a failure: report its exact command and output, then stop.

Optional checks may run only when their project configuration is detected. Do not assume Composer, PHPUnit, PHPCS, PHPStan, or an application Node suite; none is currently configured. Never use `.opencode/package.json` as an application test/build manifest.

Finish with a concise PASS/SKIP table. `$ARGUMENTS` may narrow the requested checks but must not authorize fixes or destructive actions.
