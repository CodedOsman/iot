<?php

class Partner
{
    /** @var \PDO */
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(string $name, ?string $logo = null, ?string $website = null): bool
    {
        try {
            $sql = 'INSERT INTO PARTNERS (partner_name, partner_logo, partner_website) VALUES (?, ?, ?)';
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$name, $logo, $website]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getAll(): array
    {
        try {
            return $this->pdo->query('SELECT * FROM PARTNERS')->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function find(int $id): ?array
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM PARTNERS WHERE id = ?');
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            return $row === false ? null : $row;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function update(int $id, string $name, ?string $logo = null, ?string $website = null): bool
    {
        try {
            $stmt = $this->pdo->prepare('UPDATE PARTNERS SET partner_name = ?, partner_logo = ?, partner_website = ? WHERE id = ?');
            return $stmt->execute([$name, $logo, $website, $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM PARTNERS WHERE id = ?');
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
