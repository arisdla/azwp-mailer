<!-- Context: project-intelligence/business | Priority: high | Version: 2.0 | Updated: 2026-08-30 -->

# Business Domain

> AZ's WP SMTP Mailer provides a small, self-hosted way to route WordPress email through a chosen SMTP server.

## Quick Reference

- **Project**: AZ's WP SMTP Mailer
- **Current Version**: 0.2.1
- **Primary User**: WordPress site administrators who control SMTP credentials
- **Promise**: Reliable SMTP configuration without tracking, upsells, or a large dashboard

## User Need

WordPress installations may not deliver mail reliably with host defaults. Administrators need to set the SMTP host, port, authentication, encryption, and sender identity through familiar WordPress settings.

## Value and Scope

- Configure outgoing mail through WordPress Settings.
- Apply one sender identity and SMTP connection to WordPress mail.
- Receive plugin updates from GitHub releases.
- Keep the plugin deliberately narrow; analytics, marketing, and broad mail-management features are out of scope.

## Success Signals

- Valid settings can be saved and used by PHPMailer.
- Invalid or missing required values do not replace working settings.
- Update metadata and release archives remain version-aligned.
- Security-sensitive settings and destructive removal remain protected.

## Constraints

- SMTP credentials are sensitive and stored as WordPress options.
- Compatibility depends on WordPress, PHPMailer, and the configured SMTP service.
- There is no paid service or telemetry in this repository.

## Related

- `technical-domain.md` — implementation and boundaries
- `business-tech-bridge.md` — need-to-solution mapping
- `living-notes.md` — current risks
