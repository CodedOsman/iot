<?php

class OurWorkView
{
    public function renderList(array $works): string
    {
        $html = '<h2>Our Works</h2><ul>';
        foreach ($works as $work) {
            $html .= '<li>ID: ' . $work['id'] . ', Title: ' . $work['work_title'] . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function renderForm(): string
    {
        return '<form method="post" action="" enctype="multipart/form-data">
            <label>Title: <input type="text" name="title" required></label><br>
            <label>Photo: <input type="file" name="photo"></label><br>
            <button type="submit">Add Work</button>
        </form>';
    }
}