<!-- Context: project-intelligence/decisions | Priority: high | Version: 2.0 | Updated: 2026-08-30 -->

# Decisions Log

> Records decisions evidenced by the current repository. Do not infer undocumented product commitments.

## Keep the Plugin Focused

- **Status**: Established
- **Evidence**: Root README and single plugin entry point
- **Decision**: Provide SMTP configuration without tracking, upsells, or a broad dashboard.
- **Impact**: Prefer targeted changes over adding platforms or frameworks.

## Use WordPress APIs and Hooks

- **Status**: Established
- **Evidence**: `azwp-mailer/azwp-mailer.php`
- **Decision**: Use the Settings API, mail filters, `phpmailer_init`, nonces, escaping helpers, and plugin lifecycle APIs.
- **Impact**: WordPress authorization, sanitization, and output rules are architectural requirements.

## Vendor the Update Checker

- **Status**: Established
- **Evidence**: `azwp-mailer/update-checker/` and plugin bootstrap require
- **Decision**: Ship plugin-update-checker inside the release archive.
- **Impact**: Treat it as vendor code and avoid project edits there.

## Publish Through GitHub Releases

- **Status**: Established
- **Evidence**: `.github/workflows/release.yml`
- **Decision**: Build ZIP and update JSON artifacts from version tags and maintain versioned and `latest` releases.
- **Impact**: Tag, plugin header, archive, and update JSON versions must agree; publishing and force-updating `latest` require explicit approval.

## Use Docker for Local WordPress

- **Status**: Established
- **Evidence**: `docker-compose.yml`
- **Decision**: Provide WordPress, MySQL, and phpMyAdmin services with bind-mounted plugin source.
- **Impact**: `_wordpress/`, `_db-data/`, and `.env` are local runtime state, not source.

## Related

- `technical-domain.md` — current architecture
- `living-notes.md` — unresolved concerns
