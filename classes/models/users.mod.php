<?php

class User
{
    /** @var \PDO */
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(string $username, string $password, ?int $roleId = null): bool
    {
        try {
            $sql = 'INSERT INTO USERS (user_name, password, role_id) VALUES (?, ?, ?)';
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$username, $password, $roleId]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }


    public function find(int $id): ?array
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM USERS WHERE user_id = ?');
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            return $row === false ? null : $row;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }


    public function findByUsername(string $username): ?array
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM USERS WHERE user_name = ?');
            $stmt->execute([$username]);
            $row = $stmt->fetch();
            return $row === false ? null : $row;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }


    public function getAll(): array
    {
        try {
            return $this->pdo->query('SELECT * FROM USERS')->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }


    public function updateRole(int $id, ?int $roleId): bool
    {
        try {
            $stmt = $this->pdo->prepare('UPDATE USERS SET role_id = ? WHERE user_id = ?');
            return $stmt->execute([$roleId, $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }


    public function updatePassword(int $id, string $password): bool
    {
        try {
            $stmt = $this->pdo->prepare('UPDATE USERS SET password = ? WHERE user_id = ?');
            return $stmt->execute([$password, $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    
    public function delete(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM USERS WHERE user_id = ?');
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
