---
description: Inspect changes and propose a safe, atomic Git commit
---

# Prepare Commit

Arguments: `$ARGUMENTS`

1. Inspect `git status`, unstaged/staged diffs, and recent commit subjects.
2. Never read or stage `.env`, credentials, keys, `_db-data/`, `_wordpress/`, build archives, or unrelated changes.
3. If nothing is staged, list the files that belong in one atomic commit and ask for explicit approval before staging those exact paths. Never run `git add .` or `git add -A`.
4. Run the checks relevant to the staged files using `.opencode/context/project-intelligence/validation-commands.md`. Stop and report the first failure; never auto-fix or bypass it.
5. Propose a concise conventional commit subject matching repository history. Use `$ARGUMENTS` as guidance, not as permission to commit.
6. Show the staged file list and proposed subject, then ask for explicit approval before `git commit`.
7. Do not amend, skip hooks, tag, publish, or push. A push requires a separate explicit user request and approval.

If a command fails, preserve the working tree, report the failure, and wait for direction.
