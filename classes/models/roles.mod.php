<?php

class Role
{
    /** @var \PDO */
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(string $name, ?string $description = null): bool
    {
        try {
            $sql = 'INSERT INTO ROLES (role_name, role_description) VALUES (?, ?)';
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$name, $description]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getAll(): array
    {
        try {
            return $this->pdo->query('SELECT * FROM ROLES')->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function find(int $id): ?array
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM ROLES WHERE role_id = ?');
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            return $row === false ? null : $row;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function update(int $id, string $name, ?string $description = null): bool
    {
        try {
            $stmt = $this->pdo->prepare('UPDATE ROLES SET role_name = ?, role_description = ? WHERE role_id = ?');
            return $stmt->execute([$name, $description, $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM ROLES WHERE role_id = ?');
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
