<!-- Context: project-intelligence/nav | Priority: critical | Version: 2.0 | Updated: 2026-08-30 -->

# AZWP Mailer Project Intelligence

> Start here for project-specific context; then load task-relevant core standards.

## Quick Routes

| Need | File |
|------|------|
| Product purpose and users | `business-domain.md` |
| Stack, architecture, and boundaries | `technical-domain.md` |
| Requirements mapped to implementation | `business-tech-bridge.md` |
| Established decisions | `decisions-log.md` |
| Current risks and gaps | `living-notes.md` |
| Commands available for validation | `validation-commands.md` |

## Working Order

1. Read this file and the relevant project-intelligence file.
2. Load every applicable standard from `.opencode/context/` before editing.
3. Treat `AGENTS.md` and an approved `.tmp/sessions/.../context.md` as task constraints.
4. Stop and report on validation failure; do not auto-fix.

## Boundaries

- Plugin source: `azwp-mailer/azwp-mailer.php`.
- Vendored dependency: `azwp-mailer/update-checker/` (do not edit as project source).
- Runtime data: `_wordpress/`, `_db-data/`, `.env`, and `.tmp/` artifacts.
- OAC configuration: `opencode.jsonc` and `.opencode/`.

## Related

- `../navigation.md` — bundled context routes
- `../core/standards/project-intelligence.md` — intelligence standard
- `../core/standards/project-intelligence-management.md` — maintenance rules
- `../core/context-system.md` — context architecture
