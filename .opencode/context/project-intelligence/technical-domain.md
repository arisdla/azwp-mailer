<!-- Context: project-intelligence/technical | Priority: critical | Version: 2.0 | Updated: 2026-08-30 -->

# Technical Domain

> A single-entry-point WordPress plugin with a vendored update checker and Docker-based local environment.

## Stack

| Layer | Technology | Notes |
|------|------------|-------|
| Runtime | PHP in WordPress | WordPress APIs and hooks; no Composer |
| Mail | WordPress PHPMailer | Configured through `phpmailer_init` |
| Settings | WordPress Settings API | One `azwp_mailer_settings` option |
| Updates | plugin-update-checker v5 namespace | Vendored under `azwp-mailer/update-checker/` |
| Local environment | Docker Compose | WordPress, MySQL 8.0, phpMyAdmin |
| Release | GitHub Actions/releases | Tag-driven ZIP and update JSON generation |

## Source Layout

```text
azwp-mailer/azwp-mailer.php       Plugin entry point and project source
azwp-mailer/update-checker/       Vendored dependency; do not edit
.github/workflows/release.yml     Release packaging
.github/templates/*.json.tpl      Update metadata template
docker-compose.yml                Local runtime services
.opencode/                        OpenCode/OAC configuration
```

`_wordpress/`, `_db-data/`, `.env`, `build/`, ZIPs, and `.tmp/` are runtime or generated artifacts, not source.

## Runtime Flow

1. Register the admin settings page and fields.
2. Validate required settings before replacing the stored option.
3. Override WordPress sender name/email and configure PHPMailer for SMTP.
4. Optionally delete settings and deactivate through a nonce-protected admin flow.
5. Check GitHub release metadata through the vendored updater.

## Security Boundaries

- Preserve the `ABSPATH` direct-access guard.
- Require appropriate capabilities and nonces for administrative/destructive actions.
- Sanitize and validate input; escape HTML/URLs at output.
- Treat SMTP credentials and database environment values as secrets.
- Use safe redirects and preserve the explicit exit after redirects.

## Validation

See `validation-commands.md`. No Composer, PHPUnit, PHPCS, PHPStan, or application Node suite is configured.

## Related

- `business-domain.md` — purpose and scope
- `decisions-log.md` — established choices
- `living-notes.md` — known gaps and risks
