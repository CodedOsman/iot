<?php

class PartnerView
{
    public function renderList(array $partners): string
    {
        $html = '<h2>Partners</h2><ul>';
        foreach ($partners as $partner) {
            $html .= '<li>ID: ' . $partner['id'] . ', Name: ' . $partner['partner_name'] . ', Website: ' . ($partner['partner_website'] ?? '') . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function renderForm(): string
    {
        return '<form method="post" action="">
            <label>Name: <input type="text" name="name" required></label><br>
            <label>Logo URL: <input type="text" name="logo"></label><br>
            <label>Website: <input type="url" name="website"></label><br>
            <button type="submit">Add Partner</button>
        </form>';
    }
}