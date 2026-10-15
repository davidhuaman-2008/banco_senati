<?php
namespace App\Models;

use App\Core\Model;

class PagoServicio extends Model
{
    protected string $table = 'pago_servicios';

    public function create(array $d): int
    {
        $sql = "INSERT INTO pago_servicios (cliente_id, concepto, fecha, monto)
                VALUES (:c, :co, :f, :m)";
        $this->db->prepare($sql)->execute([
            'c'  => $d['cliente_id'],
            'co' => $d['concepto'],
            'f'  => $d['fecha'],
            'm'  => $d['monto'],
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function withCliente(): array
    {
        $sql = "SELECT p.*, CONCAT(c.nombre,' ',c.apellido) AS cliente, c.n_cuenta
                FROM pago_servicios p
                JOIN clientes c ON c.id = p.cliente_id
                ORDER BY p.fecha DESC, p.id DESC";
        return $this->db->query($sql)->fetchAll();
    }
}