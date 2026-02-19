<?php

class PrivilegeView
{
    public function renderList(array $privileges): string
    {
        $html = '<h2>Privileges</h2><ul>';
        foreach ($privileges as $privilege) {
            $html .= '<li>ID: ' . $privilege['privilege_id'] . ', Name: ' . $privilege['privilege_name'] . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function renderForm(): string
    {
        return '<form method="post" action="">
            <label>Name: <input type="text" name="name" required></label><br>
            <label>Description: <textarea name="description"></textarea></label><br>
            <label>Module: <input type="text" name="module"></label><br>
            <button type="submit">Add Privilege</button>
        </form>';
    }
}