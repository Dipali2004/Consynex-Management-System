<?php
declare(strict_types=1);

spl_autoload_register(function ($class) {
    $prefix = 'TrainingApp\\App\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }
    $rel = substr($class, strlen($prefix));
    $path = __DIR__ . '/app/' . str_replace('\\', '/', $rel) . '.php';
    if (is_file($path)) {
        require $path;
    }
});

use TrainingApp\App\Router;
use TrainingApp\App\Models\Banner;
use TrainingApp\App\Models\Course;
use TrainingApp\App\Models\TrainingProgram;
use TrainingApp\App\Models\Page;
use TrainingApp\App\Models\Enquiry;

session_start();

$seg = Router::segments();

function view(string $name, array $vars = []): void
{
    extract($vars);
    require __DIR__ . '/views/layout.php';
}

function render(string $file, array $vars = []): string
{
    extract($vars);
    ob_start();
    require __DIR__ . '/views/' . $file . '.php';
    return ob_get_clean();
}

$route = $seg;
if (empty($route)) {
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $banners = Banner::allActive();
    $intro = Page::get('home_intro');
    $featuredCourses = Course::featured(6);
    $content = render('home', ['banners' => $banners, 'intro' => $intro, 'courses' => $featuredCourses, 'base' => $base]);
    view('home', ['content' => $content, 'title' => 'Home', 'base' => $base]);
    exit;
}

if ($route[0] === 'courses' && count($route) === 1) {
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $courses = Course::allActive();
    $content = render('courses_list', ['courses' => $courses, 'base' => $base]);
    view('courses_list', ['content' => $content, 'title' => 'Courses', 'base' => $base]);
    exit;
}

if ($route[0] === 'course' && isset($route[1])) {
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $course = Course::findBySlug($route[1]);
    if (!$course) {
        http_response_code(404);
        echo 'Not Found';
        exit;
    }
    $content = render('course_detail', ['course' => $course, 'base' => $base]);
    view('course_detail', ['content' => $content, 'title' => $course['name'], 'base' => $base]);
    exit;
}

if ($route[0] === 'trainings' && count($route) === 1) {
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $items = TrainingProgram::allActive();
    $content = render('trainings_list', ['items' => $items, 'base' => $base]);
    view('trainings_list', ['content' => $content, 'title' => 'Training Programs', 'base' => $base]);
    exit;
}

if ($route[0] === 'training' && isset($route[1])) {
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $item = TrainingProgram::findBySlug($route[1]);
    if (!$item) {
        http_response_code(404);
        echo 'Not Found';
        exit;
    }
    $content = render('training_detail', ['item' => $item, 'base' => $base]);
    view('training_detail', ['content' => $content, 'title' => $item['name'], 'base' => $base]);
    exit;
}

if ($route[0] === 'about') {
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $page = Page::get('about');
    $content = render('about', ['page' => $page, 'base' => $base]);
    view('about', ['content' => $content, 'title' => 'About Us', 'base' => $base]);
    exit;
}

if ($route[0] === 'contact') {
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $page = Page::get('contact');
    $content = render('contact', ['page' => $page, 'base' => $base]);
    view('contact', ['content' => $content, 'title' => 'Contact Us', 'base' => $base]);
    exit;
}

if ($route[0] === 'contact-submit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $source = trim($_POST['source'] ?? 'contact');
    if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && $message) {
        Enquiry::create(['name' => $name, 'email' => $email, 'phone' => $phone, 'message' => $message, 'source' => $source]);
        header('Location: ' . $base . '/contact?success=1');
        exit;
    }
    header('Location: ' . $base . '/contact?error=1');
    exit;
}

http_response_code(404);
echo 'Not Found';
