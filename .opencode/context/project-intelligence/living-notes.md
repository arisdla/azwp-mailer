<!-- Context: project-intelligence/notes | Priority: high | Version: 2.0 | Updated: 2026-08-30 -->

# Living Notes

> Current repository facts, risks, and maintenance reminders as of 2026-08-30.

## Current State

- Plugin version is 0.2.1.
- Runtime source is concentrated in `azwp-mailer/azwp-mailer.php`.
- No Composer, PHPUnit, PHPCS, PHPStan, or application Node test suite is configured.
- `.opencode/package.json` is tooling-only and pins `@opencode-ai/plugin`.

## Security-Sensitive Areas

- SMTP credentials and sender identity are stored in the `azwp_mailer_settings` WordPress option.
- Settings rendering, validation, mail hooks, and plugin removal need careful capability, nonce, sanitization, escaping, and redirect review when changed.
- Plugin removal permanently deletes settings and deactivates the plugin.
- Never inspect or expose `.env`, database runtime state, or real SMTP values in agent output.

## Maintenance Risks

- The release workflow force-updates the `latest` tag; never trigger or alter release behavior casually.
- The update endpoint and archive naming depend on synchronized release metadata.
- Vendored updater changes can be overwritten or complicate upgrades; leave the directory untouched unless explicitly scoped.
- Docker images use moving tags (`wordpress:latest`, `phpmyadmin`); this task does not change them.

## Validation Gap

Only syntax/configuration checks are currently available. Functional WordPress behavior and SMTP delivery require manual testing in a configured local environment. Do not claim automated coverage that does not exist.

## Change Discipline

- Keep application changes focused and WordPress-compatible.
- Add a decision entry when architecture, release, or security behavior changes.
- Update version references together for a release.

## Related

- `validation-commands.md` — available checks
- `decisions-log.md` — established decisions
- `technical-domain.md` — architecture and boundaries
