<?php

$dbPath = __DIR__ . '/../data/rebarbase.db';

if (file_exists($dbPath)) {
    echo "Database already exists at $dbPath.\n";
    exit(0);
}

// Create the SQLite database file
$pdo = new PDO("sqlite:$dbPath");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create the materials table
$pdo->exec("
    CREATE TABLE materials (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        quantity INTEGER NOT NULL,
        unit_price REAL NOT NULL
    );
");

// Insert seed data
$materials = [
    ['Rebar steel', 100, 12.50],
    ['Concrete mix', 50, 8.00],
    ['Timber', 200, 5.75],
    ['Bricks', 500, 0.30],
];

$stmt = $pdo->prepare("INSERT INTO Materials (name, quantity, unit_price) VALUES (:name, :quantity, :unitPrice)");
foreach ($materials as $material) {
    $stmt->execute([
        ':name' => $material[0],
        ':quantity' => $material[1],
        ':unitPrice' => $material[2],
    ]);
}

// Create the users table
$pdo->exec("
    CREATE TABLE users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        password TEXT NOT NULL,
        created_on TEXT NOT NULL,
        last_login_on TEXT
    );
");

// Insert seed user
$stmt = $pdo->prepare("INSERT INTO Users (username, password, created_on) VALUES (:username, :password, :createdOn)");
$stmt->execute([
    ':username' => 'testuser',
    ':password' => password_hash('testpassword', PASSWORD_DEFAULT),
    ':createdOn' => date('Y-m-d H:i:s')
]);

// Create the refresh_tokens table
$pdo->exec("
    CREATE TABLE refresh_tokens (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER NOT NULL,
        series_id INTEGER NOT NULL,
        token TEXT NOT NULL,
        expires_at TEXT NOT NULL,
        created_at TEXT NOT NULL,
        revoked_at TEXT
    );
");

echo "Database seeded successfully.\n";
