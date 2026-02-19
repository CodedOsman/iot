<?php

class OurWork
{
    /** @var \PDO */
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(string $title, ?string $photo = null): bool
    {
        try {
            $sql = 'INSERT INTO OUR_WORK (work_title, photo) VALUES (?, ?)';
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$title, $photo]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getAll(): array
    {
        try {
            return $this->pdo->query('SELECT * FROM OUR_WORK')->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function find(int $id): ?array
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM OUR_WORK WHERE id = ?');
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            return $row === false ? null : $row;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function update(int $id, string $title, ?string $photo = null): bool
    {
        try {
            $stmt = $this->pdo->prepare('UPDATE OUR_WORK SET work_title = ?, photo = ? WHERE id = ?');
            return $stmt->execute([$title, $photo, $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM OUR_WORK WHERE id = ?');
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
