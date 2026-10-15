<?php
namespace App\Core;

use App\Config\Database;
use PDO;

abstract class Model
{
    protected PDO $db;
    protected string $table;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function all(): array
    {
        return $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC")->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function count(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM {$this->table}")->fetchColumn();
    }
}