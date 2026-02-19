<?php

class RoleView
{
    public function renderList(array $roles): string
    {
        $html = '<h2>Roles</h2><ul>';
        foreach ($roles as $role) {
            $html .= '<li>ID: ' . $role['role_id'] . ', Name: ' . $role['role_name'] . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function renderForm(): string
    {
        return '<form method="post" action="">
            <label>Name: <input type="text" name="name" required></label><br>
            <label>Description: <textarea name="description"></textarea></label><br>
            <button type="submit">Add Role</button>
        </form>';
    }
}