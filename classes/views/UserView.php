<?php

class UserView
{
    public function renderList(array $users): string
    {
        $html = '<h2>Users</h2><ul>';
        foreach ($users as $user) {
            $html .= '<li>ID: ' . $user['user_id'] . ', Username: ' . $user['user_name'] . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function renderForm(): string
    {
        return '<form method="post" action="">
            <label>Username: <input type="text" name="username" required></label><br>
            <label>Password: <input type="password" name="password" required></label><br>
            <label>Role ID: <input type="number" name="roleId"></label><br>
            <button type="submit">Add User</button>
        </form>';
    }
}