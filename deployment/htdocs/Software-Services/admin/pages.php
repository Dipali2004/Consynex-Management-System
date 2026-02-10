<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';
require_login();

use TrainingApp\App\Models\Page;

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $key = $_POST['key'] ?? '';
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $data = $_POST['data'] ?? [];
    $dataJson = json_encode($data, JSON_UNESCAPED_UNICODE);
    Page::upsert($key, ['title' => $title, 'content' => $content, 'data_json' => $dataJson]);
    $msg = 'Saved';
}

$about = Page::get('about') ?? ['title' => 'About Us', 'content' => '', 'data_json' => null];
$contact = Page::get('contact') ?? ['title' => 'Contact Us', 'content' => '', 'data_json' => null];

$content = admin_render('pages', ['about' => $about, 'contact' => $contact, 'msg' => $msg]);
admin_view('pages', ['content' => $content, 'title' => 'Manage Pages']);

