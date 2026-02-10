<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';
require_login();

use TrainingApp\App\Database;
use TrainingApp\App\Models\TrainingProgram;

$db = Database::conn();
$totalCourses = (int)$db->query('SELECT COUNT(*) FROM courses')->fetchColumn();
$totalEnquiries = (int)$db->query('SELECT COUNT(*) FROM enquiries')->fetchColumn();
$totalRegistrations = (int)$db->query('SELECT COUNT(*) FROM enquiries WHERE source="registration"')->fetchColumn();
$totalTrainings = (int)$db->query('SELECT COUNT(*) FROM training_programs')->fetchColumn();
$recentEnquiries = $db->query('SELECT id, name, email, phone, source, status, created_at FROM enquiries ORDER BY id DESC LIMIT 6')->fetchAll();

$content = admin_render('dashboard', [
    'totalCourses' => $totalCourses,
    'totalEnquiries' => $totalEnquiries,
    'totalRegistrations' => $totalRegistrations,
    'totalTrainings' => $totalTrainings,
    'recentEnquiries' => $recentEnquiries,
]);
admin_view('dashboard', ['content' => $content, 'title' => 'Dashboard']);
