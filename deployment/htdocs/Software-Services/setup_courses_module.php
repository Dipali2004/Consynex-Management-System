<?php
require_once __DIR__ . '/admin/bootstrap.php';
use TrainingApp\App\Database;

try {
    $pdo = Database::conn();
    
    // Add columns if they don't exist
    $columns = ['category' => 'VARCHAR(100)', 'course_name' => 'VARCHAR(100)', 'image' => 'VARCHAR(255)'];
    
    foreach ($columns as $col => $type) {
        try {
            $pdo->query("SELECT $col FROM courses LIMIT 1");
        } catch (Exception $e) {
            $pdo->exec("ALTER TABLE courses ADD COLUMN $col $type");
            echo "Added column: $col\n";
        }
    }

    // Sync existing data (optional, but good for consistency)
    $pdo->exec("UPDATE courses SET course_name = name WHERE course_name IS NULL AND name IS NOT NULL");
    $pdo->exec("UPDATE courses SET category = level WHERE category IS NULL AND level IS NOT NULL");
    $pdo->exec("UPDATE courses SET image = image_path WHERE image IS NULL AND image_path IS NOT NULL");

    // Initial Data
    $initial_data = [
        'Professional Courses' => [
            ['Hardware and Networking', 'Comprehensive hardware and networking training.', '4 Months', '15000'],
            ['Cloud Computing', 'Master AWS, Azure, and Google Cloud platforms.', '6 Months', '25000'],
            ['Red Hat Linux', 'Red Hat Certified System Administrator (RHCSA) training.', '3 Months', '18000']
        ],
        'Programming Languages' => [
            ['C, C++', 'Foundation of programming with C and C++.', '2 Months', '8000'],
            ['Java', 'Core and Advanced Java programming.', '4 Months', '12000'],
            ['Python', 'Python programming for data science and web dev.', '3 Months', '10000']
        ]
    ];

    $stmt = $pdo->prepare("INSERT INTO courses (category, course_name, description, duration, fees, status, name, level, slug) VALUES (?, ?, ?, ?, ?, 1, ?, ?, ?)");
    $check = $pdo->prepare("SELECT COUNT(*) FROM courses WHERE course_name = ?");

    foreach ($initial_data as $cat => $courses) {
        foreach ($courses as $c) {
            $check->execute([$c[0]]);
            if ($check->fetchColumn() == 0) {
                // Generate slug
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $c[0])));
                
                // We also populate 'name' and 'level' for backward compatibility
                $stmt->execute([$cat, $c[0], $c[1], $c[2], $c[3], $c[0], $cat, $slug]);
                echo "Inserted: " . $c[0] . "\n";
            } else {
                echo "Skipped (exists): " . $c[0] . "\n";
            }
        }
    }
    
    // Create course_inquiries table
    $sql = "CREATE TABLE IF NOT EXISTS course_inquiries (
        id INT AUTO_INCREMENT PRIMARY KEY,
        course_id INT NOT NULL,
        inquiry_type VARCHAR(50) DEFAULT 'WhatsApp',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Table 'course_inquiries' ready.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
