<?php
namespace App\Models;

use App\Core\Model;

class Usuario extends Model
{
    protected string $table = 'usuarios';

    public function findByUsuario(string $usuario): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = :u AND activo = 1");
        $stmt->execute(['u' => $usuario]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $d): int
    {
        $sql = "INSERT INTO usuarios (usuario, password, rol) VALUES (:u, :p, :r)";
        $this->db->prepare($sql)->execute([
            'u' => $d['usuario'],
            'p' => password_hash($d['password'], PASSWORD_BCRYPT),
            'r' => $d['rol'] ?? 'empleado',
        ]);
        return (int) $this->db->lastInsertId();
    }
}