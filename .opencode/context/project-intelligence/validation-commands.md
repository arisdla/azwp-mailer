<!-- Context: project-intelligence/validation | Priority: critical | Version: 1.0 | Updated: 2026-08-30 -->

# Validation Commands

> Run available checks from the repository root, in order. Stop and report the first failure; never auto-fix.

## Canonical Checks

```bash
opencode debug config
php -l azwp-mailer/azwp-mailer.php
python3 -m json.tool .opencode/config/agent-metadata.json
docker compose --env-file .env.example config --quiet
```

## Rules

- Detect an executable before invoking it; report unavailable tools as skipped.
- A detected command returning non-zero is a failure and stops the run.
- Do not install missing tools or generate configuration.
- Do not treat `.opencode/package.json` as an application package.
- Run optional checks only when their configuration exists.

## Currently Unavailable

No Composer, PHPUnit, PHPCS, PHPStan, or application Node test/build suite is configured.

## Related

- `technical-domain.md` — stack and source boundaries
- `living-notes.md` — validation gaps
- `navigation.md` — project routes
