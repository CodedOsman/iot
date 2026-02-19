<?php

require_once 'classes/models/users.mod.php';

class UserController
{
    private $model;
    private $view;

    public function __construct(\PDO $pdo)
    {
        $this->model = new User($pdo);
        $this->view = new UserView();
    }

    public function index()
    {
        $users = $this->model->getAll();
        echo $this->view->renderList($users);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password']; // In real app, hash it
            $roleId = $_POST['roleId'] ?? null;
            if ($this->model->create($username, $password, $roleId)) {
                header('Location: /user');
            } else {
                echo 'Error adding user';
            }
        } else {
            echo $this->view->renderForm();
        }
    }

    public function show($id)
    {
        $user = $this->model->find($id);
        if ($user) {
            echo '<h2>User Details</h2><p>ID: ' . $user['user_id'] . ', Username: ' . $user['user_name'] . '</p>';
        } else {
            echo 'User not found';
        }
    }

    public function updateRole($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $roleId = $_POST['roleId'] ?? null;
            if ($this->model->updateRole($id, $roleId)) {
                header('Location: /user');
            } else {
                echo 'Error updating user role';
            }
        } else {
            $user = $this->model->find($id);
            if ($user) {
                echo '<form method="post" action="">
                    <label>Role ID: <input type="number" name="roleId" value="' . ($user['role_id'] ?? '') . '"></label><br>
                    <button type="submit">Update Role</button>
                </form>';
            } else {
                echo 'User not found';
            }
        }
    }

    public function updatePassword($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'];
            if ($this->model->updatePassword($id, $password)) {
                header('Location: /user');
            } else {
                echo 'Error updating password';
            }
        } else {
            echo '<form method="post" action="">
                <label>New Password: <input type="password" name="password" required></label><br>
                <button type="submit">Update Password</button>
            </form>';
        }
    }

    public function delete($id)
    {
        if ($this->model->delete($id)) {
            header('Location: /user');
        } else {
            echo 'Error deleting user';
        }
    }
}