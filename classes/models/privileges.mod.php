<?php

class Privilege
{
    /** @var \PDO */
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(string $name, ?string $description = null, ?string $module = null): bool
    {
        try {
            $sql = 'INSERT INTO PRIVILEGES (privilege_name, privilege_description, module) VALUES (?, ?, ?)';
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$name, $description, $module]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getAll(): array
    {
        try {
            return $this->pdo->query('SELECT * FROM PRIVILEGES')->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function find(int $id): ?array
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM PRIVILEGES WHERE privilege_id = ?');
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            return $row === false ? null : $row;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function update(int $id, string $name, ?string $description = null, ?string $module = null): bool
    {
        try {
            $stmt = $this->pdo->prepare('UPDATE PRIVILEGES SET privilege_name = ?, privilege_description = ?, module = ? WHERE privilege_id = ?');
            return $stmt->execute([$name, $description, $module, $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM PRIVILEGES WHERE privilege_id = ?');
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
