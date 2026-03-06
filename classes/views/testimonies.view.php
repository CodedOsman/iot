<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../models/testimonies.mod.php';

function getTestimoniesData() {
    $pdo = DB::getConnection();
    $testimonyModel = new Testimony($pdo);
    return $testimonyModel->getAll();
}
