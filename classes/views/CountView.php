<?php

class CountView
{
    public function renderList(array $counts): string
    {
        $html = '<h2>Counts</h2><ul>';
        foreach ($counts as $count) {
            $html .= '<li>ID: ' . $count['id'] . ', Impact: ' . $count['count_impact'] . ', Project: ' . $count['count_project'] . ', Member: ' . $count['count_member'] . ', Trainees: ' . $count['count_trainees'] . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function renderForm(): string
    {
        return '<form method="post" action="">
            <label>Impact: <input type="number" name="impact"></label><br>
            <label>Project: <input type="number" name="project"></label><br>
            <label>Member: <input type="number" name="member"></label><br>
            <label>Trainees: <input type="number" name="trainees"></label><br>
            <button type="submit">Add Count</button>
        </form>';
    }
}