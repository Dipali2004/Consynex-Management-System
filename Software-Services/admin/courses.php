<?php
require_once __DIR__ . '/bootstrap.php';
use TrainingApp\App\Database;

require_login();

$pdo = Database::conn();
$action = $_GET['action'] ?? 'list';
$error = '';
$msg = $_GET['msg'] ?? '';

// Helper to handle file upload
function handle_image_upload($file) {
    if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            // Validate size (2MB)
            if ($file['size'] <= 2 * 1024 * 1024) {
                $uploadDir = '../uploads/courses/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $filename = uniqid('course_') . '.' . $ext;
                $destination = $uploadDir . $filename;
                
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    return 'uploads/courses/' . $filename;
                }
            }
        }
    }
    return null;
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'add' || $action === 'edit') {
        $id = $_POST['id'] ?? null;
        $course_name = trim($_POST['course_name']);
        $category = trim($_POST['category']);
        $description = trim($_POST['description']);
        $duration = trim($_POST['duration']);
        $fees = trim($_POST['fees']);
        $status = isset($_POST['status']) ? 1 : 0;
        
        // Image processing
        $image = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = handle_image_upload($_FILES['image']);
        } elseif ($action === 'edit' && isset($_POST['existing_image'])) {
            $image = $_POST['existing_image'];
        }
        
        // Validation
        if (empty($course_name) || empty($category)) {
            $error = "Course Name and Category are required.";
        } else {
            // Slug generation
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $course_name)));
            
            if (empty($error)) {
                if ($id) {
                    // Update
                    if ($image) {
                        $stmt = $pdo->prepare("UPDATE courses SET category=?, course_name=?, description=?, duration=?, fees=?, image=?, status=?, slug=?, name=?, level=? WHERE id=?");
                        $stmt->execute([$category, $course_name, $description, $duration, $fees, $image, $status, $slug, $course_name, $category, $id]);
                    } else {
                        $stmt = $pdo->prepare("UPDATE courses SET category=?, course_name=?, description=?, duration=?, fees=?, status=?, slug=?, name=?, level=? WHERE id=?");
                        $stmt->execute([$category, $course_name, $description, $duration, $fees, $status, $slug, $course_name, $category, $id]);
                    }
                    $msg = "Course updated successfully.";
                } else {
                    // Create
                    $stmt = $pdo->prepare("INSERT INTO courses (category, course_name, description, duration, fees, image, status, slug, name, level) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$category, $course_name, $description, $duration, $fees, $image, $status, $slug, $course_name, $category]);
                    $msg = "Course created successfully.";
                }
                header("Location: courses.php?msg=" . urlencode($msg));
                exit;
            }
        }
    }
}

// Handle Actions
if ($action === 'delete' && !empty($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header('Location: courses.php?msg=Course deleted successfully');
    exit;
}

if ($action === 'toggle_status' && !empty($_GET['id']) && isset($_GET['status'])) {
    $stmt = $pdo->prepare("UPDATE courses SET status = ? WHERE id = ?");
    $stmt->execute([$_GET['status'], $_GET['id']]);
    header('Location: courses.php?msg=Status updated successfully');
    exit;
}

// Render Views
if ($action === 'add' || $action === 'edit') {
    $course = null;
    if ($action === 'edit' && !empty($_GET['id'])) {
        $stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $course = $stmt->fetch();
    } elseif (!empty($_POST)) {
        // Repopulate form on error
        $course = $_POST;
        if (isset($_POST['existing_image'])) $course['image'] = $_POST['existing_image'];
    }
    
    admin_view('courses_form', [
        'title' => ($action === 'edit' ? 'Edit Course' : 'Add New Course'),
        'course' => $course,
        'error' => $error
    ]);
} else {
    // List View
    $stmt = $pdo->query("SELECT * FROM courses ORDER BY category, course_name");
    $courses = $stmt->fetchAll();
    
    admin_view('courses_list', [
        'title' => 'Courses Management',
        'courses' => $courses,
        'msg' => $msg,
        'error' => $error
    ]);
}
