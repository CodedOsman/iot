<?php

class TeamView
{
    public function renderList(array $teams): string
    {
        $html = '<h2>Team</h2><ul>';
        foreach ($teams as $team) {
            $html .= '<li>ID: ' . $team['id'] . ', Name: ' . $team['name'] . ', Position: ' . $team['position'] . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function renderForm(): string
    {
        return '<form method="post" action="" enctype="multipart/form-data">
            <label>Name: <input type="text" name="name" required></label><br>
            <label>Position: <input type="text" name="position" required></label><br>
            <label>Photo: <input type="file" name="photo"></label><br>
            <label>Facebook: <input type="url" name="facebook"></label><br>
            <label>Instagram: <input type="url" name="instagram"></label><br>
            <label>Twitter: <input type="url" name="twitter"></label><br>
            <label>LinkedIn: <input type="url" name="linkedin"></label><br>
            <button type="submit">Add Team Member</button>
        </form>';
    }
}