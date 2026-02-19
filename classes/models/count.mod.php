<?php

class Count
{
    /** @var \PDO */
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addCount(int $impact = 0, int $project = 0, int $member = 0, int $trainees = 0): bool
    {
        try {
            $sql = 'INSERT INTO `COUNT` (count_impact, count_project, count_member, count_trainees) VALUES (?, ?, ?, ?)';
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$impact, $project, $member, $trainees]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getAll(): array
    {
        try {
            return $this->pdo->query('SELECT * FROM `COUNT`')->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function find(int $id): ?array
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM `COUNT` WHERE id = ?');
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            return $row === false ? null : $row;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function update(int $id, int $impact, int $project, int $member, int $trainees): bool
    {
        try {
            $stmt = $this->pdo->prepare('UPDATE `COUNT` SET count_impact = ?, count_project = ?, count_member = ?, count_trainees = ? WHERE id = ?');
            return $stmt->execute([$impact, $project, $member, $trainees, $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}