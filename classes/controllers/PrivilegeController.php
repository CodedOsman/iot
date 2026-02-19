<?php

require_once 'classes/models/privileges.mod.php';

class PrivilegeController
{
    private $model;
    private $view;

    public function __construct(\PDO $pdo)
    {
        $this->model = new Privilege($pdo);
        $this->view = new PrivilegeView();
    }

    public function index()
    {
        $privileges = $this->model->getAll();
        echo $this->view->renderList($privileges);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'] ?? null;
            $module = $_POST['module'] ?? null;
            if ($this->model->create($name, $description, $module)) {
                header('Location: /privilege');
            } else {
                echo 'Error adding privilege';
            }
        } else {
            echo $this->view->renderForm();
        }
    }

    public function show($id)
    {
        $privilege = $this->model->find($id);
        if ($privilege) {
            echo '<h2>Privilege Details</h2><p>ID: ' . $privilege['privilege_id'] . ', Name: ' . $privilege['privilege_name'] . '</p>';
        } else {
            echo 'Privilege not found';
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'] ?? null;
            $module = $_POST['module'] ?? null;
            if ($this->model->update($id, $name, $description, $module)) {
                header('Location: /privilege');
            } else {
                echo 'Error updating privilege';
            }
        } else {
            $privilege = $this->model->find($id);
            if ($privilege) {
                echo '<form method="post" action="">
                    <label>Name: <input type="text" name="name" value="' . $privilege['privilege_name'] . '" required></label><br>
                    <label>Description: <textarea name="description">' . ($privilege['privilege_description'] ?? '') . '</textarea></label><br>
                    <label>Module: <input type="text" name="module" value="' . ($privilege['module'] ?? '') . '"></label><br>
                    <button type="submit">Update Privilege</button>
                </form>';
            } else {
                echo 'Privilege not found';
            }
        }
    }

    public function delete($id)
    {
        if ($this->model->delete($id)) {
            header('Location: /privilege');
        } else {
            echo 'Error deleting privilege';
        }
    }
}