<?php

$host = getenv('DB_HOST') ?: 'mysql';
$db   = getenv('MYSQL_DATABASE');
$user = getenv('MYSQL_USER');
$pass = getenv('MYSQL_PASSWORD');

$adminUser = getenv('ADMIN_USERNAME');
$adminPass = getenv('ADMIN_PASSWORD');

if (!$db || !$user || !$pass || !$adminUser || !$adminPass) {
    fwrite(STDERR, "Lipsesc variabilele de environment necesare.\n");
    exit(1);
}

try {
    $pdo = new PDO(
        "mysql:host={$host};dbname={$db};charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    // Verificăm dacă adminul există deja.
    $stmt = $pdo->prepare(
        'SELECT id_admin
         FROM admin
         WHERE admin_nume = ?'
    );

    $stmt->execute([$adminUser]);

    if ($stmt->fetch()) {
        echo "Adminul '{$adminUser}' există deja. Nu se modifică.\n";
        exit(0);
    }

    // Generăm hash-ul parolei.
    $passwordHash = password_hash(
        $adminPass,
        PASSWORD_DEFAULT
    );

    // Creăm adminul.
    $stmt = $pdo->prepare(
        'INSERT INTO admin (admin_nume, admin_parola)
         VALUES (?, ?)'
    );

    $stmt->execute([
        $adminUser,
        $passwordHash
    ]);

    echo "Adminul '{$adminUser}' a fost creat cu succes.\n";

} catch (PDOException $e) {
    fwrite(STDERR, "Eroare la inițializarea adminului: {$e->getMessage()}\n");
    exit(1);
}