<?php
namespace App\Models;

use App\Core\Model;

class Retiro extends Model
{
    protected string $table = 'retiros';

    public function create(array $d): int
    {
        $sql = "INSERT INTO retiros (cliente_id, fecha, monto) VALUES (:c, :f, :m)";
        $this->db->prepare($sql)->execute([
            'c' => $d['cliente_id'], 'f' => $d['fecha'], 'm' => $d['monto'],
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function withCliente(): array
    {
        $sql = "SELECT r.*, CONCAT(c.nombre,' ',c.apellido) AS cliente, c.n_cuenta
                FROM retiros r
                JOIN clientes c ON c.id = r.cliente_id
                ORDER BY r.fecha DESC, r.id DESC";
        return $this->db->query($sql)->fetchAll();
    }
}