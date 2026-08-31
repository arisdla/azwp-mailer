# OpenCode/OAC in AZWP Mailer

This directory contains project-local OpenAgents Control agents, commands, skills, and context for the PHP/WordPress plugin.

## Start here

1. Start OpenCode from the repository root so `opencode.jsonc` is loaded.
2. Use the default `openagent` (`OpenAgent`), or select `opencoder` (`OpenCoder`) for larger implementation work.
3. Read `../AGENTS.md` and `.opencode/context/project-intelligence/navigation.md`.
4. Load the standards relevant to files being edited before making changes.
5. Keep shell and edit approval gates; stop and report if a check fails.

Restart OpenCode after changing `opencode.jsonc`, agents, commands, skills, or plugins because configuration is loaded at startup.

## Project commands

- `/test` — run the repository's available PHP check and report results.
- `/validate-repo` — run OpenCode config, PHP syntax, metadata JSON, and Docker Compose checks; optional tools are used only when detected.
- `/commit` — inspect and propose an atomic commit; staging, committing, and pushing each require explicit approval.

## Context layout

- `context/project-intelligence/` — AZWP Mailer architecture, decisions, current risks, and checks.
- `context/core/` — reusable OAC standards and workflows; load selectively.
- `context/navigation.md` — top-level routes.

Do not treat `.opencode/package.json` as an application package: it pins OpenCode plugin tooling only. `node_modules/` remains generated and ignored; the package manifest and lockfile are committed for reproducibility.
