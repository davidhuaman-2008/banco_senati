<?php
require __DIR__ . "/../vendor/autoload.php";

use Dotenv\Dotenv;
use App\Config\Database;

$dotenv = Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

header("Content-Type: text/plain; charset=utf-8");

try {
    $db = Database::getInstance();
    echo "OK - Conexion exitosa\n\n";

    echo "Usuarios actuales:\n";
    $rows = $db->query("SELECT id, usuario, rol FROM usuarios")->fetchAll();
    foreach ($rows as $r) {
        echo "  - ID: {$r["id"]} | usuario: {$r["usuario"]} | rol: {$r["rol"]}\n";
    }

    $nuevoHash = password_hash("admin123", PASSWORD_BCRYPT);
    echo "\nHash generado: $nuevoHash\n";

    $db->exec("DELETE FROM usuarios WHERE usuario = 'admin'");
    $stmt = $db->prepare("INSERT INTO usuarios (usuario, password, rol) VALUES (:u, :p, :r)");
    $stmt->execute(["u" => "admin", "p" => $nuevoHash, "r" => "admin"]);
    echo "\nUsuario admin regenerado\n";

    $stmt = $db->prepare("SELECT * FROM usuarios WHERE usuario = 'admin'");
    $stmt->execute();
    $admin = $stmt->fetch();

    echo "\nVerificacion:\n";
    echo "  Usuario: {$admin["usuario"]}\n";
    echo "  Rol: {$admin["rol"]}\n";
    echo "  Activo: {$admin["activo"]}\n";
    echo "  Hash: {$admin["password"]}\n";

    $verify = password_verify("admin123", $admin["password"]);
    echo "\npassword_verify = " . ($verify ? "TRUE" : "FALSE") . "\n";

    echo "\n=======================================\n";
    if ($verify) {
        echo "LISTO: login con admin / admin123\n";
    } else {
        echo "ALGO FALLA\n";
    }
    echo "=======================================\n";

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
