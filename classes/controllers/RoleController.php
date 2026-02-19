<?php

require_once 'classes/models/roles.mod.php';

class RoleController
{
    private $model;
    private $view;

    public function __construct(\PDO $pdo)
    {
        $this->model = new Role($pdo);
        $this->view = new RoleView();
    }

    public function index()
    {
        $roles = $this->model->getAll();
        echo $this->view->renderList($roles);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'] ?? null;
            if ($this->model->create($name, $description)) {
                header('Location: /role');
            } else {
                echo 'Error adding role';
            }
        } else {
            echo $this->view->renderForm();
        }
    }

    public function show($id)
    {
        $role = $this->model->find($id);
        if ($role) {
            echo '<h2>Role Details</h2><p>ID: ' . $role['role_id'] . ', Name: ' . $role['role_name'] . '</p>';
        } else {
            echo 'Role not found';
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'] ?? null;
            if ($this->model->update($id, $name, $description)) {
                header('Location: /role');
            } else {
                echo 'Error updating role';
            }
        } else {
            $role = $this->model->find($id);
            if ($role) {
                echo '<form method="post" action="">
                    <label>Name: <input type="text" name="name" value="' . $role['role_name'] . '" required></label><br>
                    <label>Description: <textarea name="description">' . ($role['role_description'] ?? '') . '</textarea></label><br>
                    <button type="submit">Update Role</button>
                </form>';
            } else {
                echo 'Role not found';
            }
        }
    }

    public function delete($id)
    {
        if ($this->model->delete($id)) {
            header('Location: /role');
        } else {
            echo 'Error deleting role';
        }
    }
}