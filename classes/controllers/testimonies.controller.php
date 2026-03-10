<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../models/testimonies.mod.php';

class TestimoniesController {
    private $testimony;
    public function __construct($pdo) {
        $this->testimony = new Testimony($pdo);
    }
    public function index() {
        return $this->testimony->getAll();
    }
    public function show($id) {
        return $this->testimony->find($id);
    }
    public function store($data) {
        // if file paths are passed they should already be relative to uploads/
        return $this->testimony->create(
            $data['picture'] ?? '',
            $data['message'] ?? '',
            $data['name'] ?? '',
            $data['position'] ?? '',
            $data['avatar'] ?? ''
        );
    }
    public function update($id, $data) {
        // existing picture/avatar should be passed in data array if not replaced
        return $this->testimony->update(
            $id,
            $data['picture'] ?? '',
            $data['message'] ?? '',
            $data['name'] ?? '',
            $data['position'] ?? '',
            $data['avatar'] ?? ''
        );
    }
    public function destroy($id) {
        return $this->testimony->delete($id);
    }
}
