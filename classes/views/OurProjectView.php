<?php

class OurProjectView
{
    public function renderList(array $projects): string
    {
        $html = '<h2>Our Projects</h2><ul>';
        foreach ($projects as $project) {
            $html .= '<li>ID: ' . $project['id'] . ', Name: ' . $project['project_name'] . ', Description: ' . ($project['project_description'] ?? '') . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function renderForm(): string
    {
        return '<form method="post" action="" enctype="multipart/form-data">
            <label>Name: <input type="text" name="name" required></label><br>
            <label>Description: <textarea name="description"></textarea></label><br>
            <label>Photo: <input type="file" name="photo"></label><br>
            <button type="submit">Add Project</button>
        </form>';
    }
}