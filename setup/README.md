# Setup Scripts

This folder contains scripts intended to help you set up the example project.

## Scripts

- **`seed.php`**: Initializes an SQLite database with example data for the application.
- **`change_namespace.php`**: Change the namespace used for the project in composer file and in source files in `src/` and `app/` folders.

## Usage

If you installed this project using Composer, the setup scripts may have been run automatically during installation. However, if you downloaded the project as a zip file or skipped the post-installation steps, you will need to run the setup scripts manually.

To manually execute the seeder script, run the following command from the project root:

```bash
php setup/seed.php
```

To manually change the project namespace, run the following command from the project root (you will be prompted for the new namespace name).

```bash
php setup/change_namespace.php
```

## Cleanup

After running the scripts, you can safely delete this folder if no longer needed.
