<?php
namespace App\Models;

use App\Core\Model;

class Deposito extends Model
{
    protected string $table = 'depositos';

    public function create(array $d): int
    {
        $sql = "INSERT INTO depositos (cliente_id, fecha, monto) VALUES (:c, :f, :m)";
        $this->db->prepare($sql)->execute([
            'c' => $d['cliente_id'], 'f' => $d['fecha'], 'm' => $d['monto'],
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function withCliente(): array
    {
        $sql = "SELECT d.*, CONCAT(c.nombre,' ',c.apellido) AS cliente, c.n_cuenta
                FROM depositos d
                JOIN clientes c ON c.id = d.cliente_id
                ORDER BY d.fecha DESC, d.id DESC";
        return $this->db->query($sql)->fetchAll();
    }
}