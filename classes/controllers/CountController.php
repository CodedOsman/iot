<?php

require_once 'classes/models/count.mod.php';

class CountController
{
    private $model;
    private $view;

    public function __construct(\PDO $pdo)
    {
        $this->model = new Count($pdo);
        $this->view = new CountView();
    }

    public function index()
    {
        $counts = $this->model->getAll();
        echo $this->view->renderList($counts);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $impact = $_POST['impact'] ?? 0;
            $project = $_POST['project'] ?? 0;
            $member = $_POST['member'] ?? 0;
            $trainees = $_POST['trainees'] ?? 0;
            if ($this->model->addCount($impact, $project, $member, $trainees)) {
                header('Location: /count');
            } else {
                echo 'Error adding count';
            }
        } else {
            echo $this->view->renderForm();
        }
    }

    public function show($id)
    {
        $count = $this->model->find($id);
        if ($count) {
            echo '<h2>Count Details</h2><p>ID: ' . $count['id'] . ', Impact: ' . $count['count_impact'] . '</p>';
        } else {
            echo 'Count not found';
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $impact = $_POST['impact'];
            $project = $_POST['project'];
            $member = $_POST['member'];
            $trainees = $_POST['trainees'];
            if ($this->model->update($id, $impact, $project, $member, $trainees)) {
                header('Location: /count');
            } else {
                echo 'Error updating count';
            }
        } else {
            $count = $this->model->find($id);
            if ($count) {
                echo '<form method="post" action="">
                    <label>Impact: <input type="number" name="impact" value="' . $count['count_impact'] . '"></label><br>
                    <label>Project: <input type="number" name="project" value="' . $count['count_project'] . '"></label><br>
                    <label>Member: <input type="number" name="member" value="' . $count['count_member'] . '"></label><br>
                    <label>Trainees: <input type="number" name="trainees" value="' . $count['count_trainees'] . '"></label><br>
                    <button type="submit">Update Count</button>
                </form>';
            } else {
                echo 'Count not found';
            }
        }
    }
}