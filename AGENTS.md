# cindemirwebsite

A WordPress website. The repository root is the WordPress document root; custom,
tracked code lives under `wp-content/mu-plugins`, `wp-content/plugins`, and
`wp-content/themes` (see `.gitignore`). WordPress core and third-party
dependencies are intentionally not committed.

## Cursor Cloud specific instructions

### What the environment provides (baked into the VM snapshot)

The following are installed/generated during environment setup and are **not**
committed to git (so they will not appear in a diff, but persist in the VM):

- PHP 8.3 CLI with extensions (`sqlite3`, `pdo_sqlite`, `curl`, `mbstring`, `gd`, `xml`, `zip`, `intl`).
- WP-CLI installed as `wp` (invoke with `--allow-root` in this environment).
- WordPress core downloaded into the repo root (`wp-load.php`, `wp-admin/`, `wp-includes/`, etc.).
- `wp-config.php` in the repo root.
- Database: **SQLite** (no MySQL/MariaDB service). Provided by the
  `sqlite-database-integration` plugin plus the `wp-content/db.php` drop-in.
  The DB file lives at `wp-content/database/.ht.sqlite`.
- Admin credentials for the local site: user `admin`, password `admin123`.

### Running the site

There is no build step. Start the dev server from the repo root:

```
wp server --host=0.0.0.0 --port=8080 --allow-root
```

Then browse:
- Front end: `http://localhost:8080/`
- Admin: `http://localhost:8080/wp-admin` (login `admin` / `admin123`)

`wp server` runs PHP's built-in server with WordPress routing. Plain
`php -S 0.0.0.0:8080 -t .` also works for static/simple requests but does not
handle pretty-permalink routing, so prefer `wp server`.

### Lint / test / build

This repository defines no lint/test/build tooling (no `composer.json`,
`package.json`, `phpunit`, or `phpcs` config). For a quick PHP syntax check of a
file use `php -l <file>`. Manage the site with WP-CLI, e.g. `wp plugin list
--allow-root`, `wp post list --allow-root`.

### Gotcha: `.gitignore` does not ignore WordPress core

The root `.gitignore` intends to ignore everything except tracked `wp-content`
subfolders, but it is missing the top-level `*` rule, so downloaded WordPress
core files (`wp-admin/`, `wp-includes/`, `index.php`, etc.) show up as
**untracked**. Do **not** run `git add .` / `git add -A` blindly or you will
commit WordPress core. Stage only intended files (custom code under
`wp-content/{mu-plugins,plugins,themes}` and this `AGENTS.md`).
