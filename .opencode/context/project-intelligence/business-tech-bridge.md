<!-- Context: project-intelligence/bridge | Priority: high | Version: 2.0 | Updated: 2026-08-30 -->

# Business ↔ Tech Bridge

> Maps the plugin's deliberately small product scope to its implementation.

## Core Mapping

| Business Need | Technical Solution | Value / Trade-off |
|---------------|-------------------|-------------------|
| Configure SMTP without bloat | One WordPress settings page and one option | Simple administration; limited advanced features |
| Route all WordPress mail consistently | `wp_mail_from`, `wp_mail_from_name`, and `phpmailer_init` hooks | Site-wide behavior from one configuration |
| Protect working configuration | Validation callback returns existing options on missing required fields | Avoids replacing valid settings with incomplete input |
| Remove sensitive settings | Nonce-protected delete/deactivate flow | Clear destructive action; must retain strong authorization |
| Deliver updates outside WordPress.org | Vendored update checker reads GitHub release JSON | Direct releases; metadata/tag/version alignment is critical |
| Reproduce local WordPress | Docker Compose mounts plugin source into WordPress | Low setup overhead; runtime directories must stay untracked |

## Release Mapping

The `vMAJOR.MINOR.PATCH` tag must match the plugin header. CI packages the full `azwp-mailer/` directory, generates versioned update JSON, and publishes versioned plus `latest` assets. Release operations are therefore sensitive and require explicit approval.

## Change Priorities

1. Preserve secure settings and removal behavior.
2. Preserve mail delivery and update compatibility.
3. Keep the plugin lightweight.
4. Avoid unrelated source, Docker, or release refactoring.

## Related

- `business-domain.md` — user value
- `technical-domain.md` — implementation details
- `decisions-log.md` — rationale
