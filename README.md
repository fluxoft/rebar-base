# Rebar Base App

**Rebar Base App** is a barebones starter project for building applications with the [Rebar framework](https://github.com/fluxoft/rebar). It provides a minimal implementation to help you quickly get started with Rebar, including basic routing, an example controller, and an optional SQLite-based example for managing data.

## Features

- Minimal setup for building with Rebar.
- Example route (`/`) and controller (`Hello`) to get started.
- Optional SQLite database example with seed data.
- Easy extensibility for creating custom controllers, services, mappers, and models.

## Folder Structure

```
rebar-base/
├── app/                  # Bootstrapping and configuration scripts.
│   ├── bootstrap.php     # Application bootstrap script.
│   ├── container.php     # Dependency injection container.
│
├── src/                  # PSR-4 namespace root for application logic.
│   ├── Controllers/      # Example controllers.
│   └── Models/           # Example models.
│
├── data/                 # Example SQLite database (optional).
│   └── rebarbase.db      # Example SQLite database file.
│
├── public/               # Publicly accessible directory.
│   └── index.php         # Entry point for the application.
│
├── setup/                # Setup scripts for initializing the example project.
│   ├── seed.php          # Script to seed the example SQLite database.
│   └── README.md         # Instructions for using the setup scripts.
│
├── vendor/               # Composer-managed dependencies (auto-generated).
└── composer.json         # Project dependencies and configuration.
```

## Getting Started

## Installation

To get started, you can create a new project using Composer:

```bash
composer create-project fluxoft/rebar-base my-app
```

Alternatively, you can clone this repository and install the dependencies:

```bash
git clone https://github.com/fluxoft/rebar-base.git my-app
cd my-app
composer install
```

### Initial Setup

If you installed this project via Composer, the setup scripts (e.g., for seeding the example SQLite database) will run automatically.

For manual installations or additional details about the setup scripts, refer to [setup/README.md](setup/README.md).

### Running the Application

You can serve the application locally using PHP's built-in server:

```bash
php -S localhost:8000 -t public
```

Visit [http://localhost:8000](http://localhost:8000) in your browser to see the example app in action.

## Extending the App

The Rebar Base App is designed to be a starting point. You can extend it by adding:

- **Controllers**: Add custom controllers to handle new routes.
- **Models and Mappers**: Integrate your database logic.
- **Services**: Create reusable application services.

Refer to the [Rebar documentation](https://github.com/fluxoft/rebar) for guidance.

## Cleanup

If you do not need the example project, you can delete the `data/` and `setup/` folders after installation.

## Contributing

Contributions are welcome! Feel free to open issues or submit pull requests to improve the project.

## License

This project is licensed under the MIT License. See the `LICENSE` file for details.
