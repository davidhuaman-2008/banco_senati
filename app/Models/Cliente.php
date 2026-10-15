<?php
namespace App\Models;

use App\Core\Model;

class Cliente extends Model
{
    protected string $table = 'clientes';

    public function create(array $d): int
    {
        $sql = "INSERT INTO clientes (n_cuenta, nombre, apellido, dni, email, telefono)
                VALUES (:n_cuenta, :nombre, :apellido, :dni, :email, :telefono)";
        $this->db->prepare($sql)->execute([
            'n_cuenta' => $d['n_cuenta'],
            'nombre'   => $d['nombre'],
            'apellido' => $d['apellido'],
            'dni'      => $d['dni'],
            'email'    => $d['email'] ?? null,
            'telefono' => $d['telefono'] ?? null,
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $d): bool
    {
        $sql = "UPDATE clientes SET nombre=:nombre, apellido=:apellido,
                dni=:dni, email=:email, telefono=:telefono WHERE id=:id";
        return $this->db->prepare($sql)->execute([
            'nombre'   => $d['nombre'],
            'apellido' => $d['apellido'],
            'dni'      => $d['dni'],
            'email'    => $d['email'] ?? null,
            'telefono' => $d['telefono'] ?? null,
            'id'       => $id,
        ]);
    }

        public function saldo(int $cliente_id): float
    {
        $sql = "SELECT
            (SELECT COALESCE(SUM(monto),0) FROM depositos       WHERE cliente_id=:id1) -
            (SELECT COALESCE(SUM(monto),0) FROM retiros         WHERE cliente_id=:id2) -
            (SELECT COALESCE(SUM(monto),0) FROM pago_servicios  WHERE cliente_id=:id3)
            AS saldo";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id1' => $cliente_id,
            'id2' => $cliente_id,
            'id3' => $cliente_id,
        ]);
        return (float) $stmt->fetchColumn();
    }
}