# Repository Instructions

## Architecture and boundaries

- This repository ships **AZ's WP SMTP Mailer**, currently version **0.2.1**.
- `azwp-mailer/azwp-mailer.php` is the plugin source and WordPress entry point.
- `azwp-mailer/update-checker/` is vendored `plugin-update-checker`; do not edit it as project source.
- `docker-compose.yml`, `.env.example`, `_wordpress/`, and `_db-data/` support local WordPress development. The underscored directories are runtime data, not source.
- `.github/workflows/release.yml` packages `azwp-mailer/`; `.github/templates/azwp-mailer.json.tpl` defines update metadata.
- `.opencode/` and `opencode.jsonc` contain project OpenCode/OpenAgents Control configuration, not plugin runtime code.

## Canonical checks

Run only checks available in this repository, and stop/report on the first failure. Do not auto-fix.

```bash
opencode debug config
php -l azwp-mailer/azwp-mailer.php
python3 -m json.tool .opencode/config/agent-metadata.json
docker compose --env-file .env.example config --quiet
```

There is currently no Composer, PHPUnit, PHPCS, PHPStan, or application Node test suite. `.opencode/package.json` supplies OpenCode tooling only.

## Security-sensitive work

- SMTP host, username, password, sender identity, and encryption settings are sensitive WordPress options.
- Preserve capability checks, nonces, input validation/sanitization, output escaping, safe redirects, and the direct-access guard.
- Plugin removal deletes settings and deactivates the plugin; treat changes to this path as destructive.
- Never read, edit, stage, or disclose `.env`, credentials, keys, database runtime data, or generated WordPress state.

## Releases and versions

- Release tags are `vMAJOR.MINOR.PATCH` and must exactly match the plugin header version.
- Keep the plugin header, release tag, archive names, and generated update JSON version aligned.
- Do not edit release workflow behavior or move vendored dependencies unless explicitly requested.
- Never tag, publish, push, or force-update `latest` without explicit user approval.

## OpenAgents Control workflow

- Start at `.opencode/context/project-intelligence/navigation.md` and load only relevant context.
- Before editing, load every applicable standards file under `.opencode/context/`; project-specific context does not replace standards.
- Use `.tmp/sessions/.../context.md` as the approved task source of truth when supplied. Do not delete session/task artifacts without approval.
- Approval is required for shell and edit operations. On validation failure: stop, report, and wait for direction; do not auto-fix.
