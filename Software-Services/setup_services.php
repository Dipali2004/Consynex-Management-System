<?php
require_once __DIR__ . '/admin/bootstrap.php';

use TrainingApp\App\Database;

try {
    $pdo = Database::conn();
    
    // Create table
    $sql = "CREATE TABLE IF NOT EXISTS services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category VARCHAR(50) NOT NULL,
        service_name VARCHAR(100) NOT NULL,
        description TEXT,
        icon VARCHAR(255),
        status TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Table 'services' created or already exists.\n";

    // Initial Data
    $services = [
        [
            'category' => 'Core IT',
            'items' => [
                ['Computer / Laptop Support', 'Expert repair and support for desktops and laptops.', 'bi bi-laptop'],
                ['System Installation & Formatting', 'OS installation, formatting, and driver setup.', 'bi bi-hdd'],
                ['Software Installation & Licensing', 'Installing essential software and managing licenses.', 'bi bi-box-seam'],
                ['Antivirus & Security Setup', 'Protection against malware, viruses, and cyber threats.', 'bi bi-shield-check'],
                ['Data Backup & Recovery', 'Secure data backup solutions and disaster recovery.', 'bi bi-database']
            ]
        ],
        [
            'category' => 'Networking & Office IT',
            'items' => [
                ['LAN / Wi-Fi Setup', 'Complete local area network and Wi-Fi configuration.', 'bi bi-wifi'],
                ['Router & Switch Configuration', 'Advanced routing and switching setup for offices.', 'bi bi-router'],
                ['CCTV Installation & Support', 'Surveillance system installation and maintenance.', 'bi bi-camera-video'],
                ['Office IT Infrastructure Support', 'End-to-end IT infrastructure management.', 'bi bi-building'],
                ['AMC (Annual Maintenance)', 'Yearly maintenance contracts for hassle-free IT.', 'bi bi-tools']
            ]
        ]
    ];

    $stmt = $pdo->prepare("INSERT INTO services (category, service_name, description, icon, status) VALUES (?, ?, ?, ?, 1)");

    foreach ($services as $group) {
        foreach ($group['items'] as $item) {
            // Check if exists to avoid duplicates
            $check = $pdo->prepare("SELECT COUNT(*) FROM services WHERE service_name = ?");
            $check->execute([$item[0]]);
            if ($check->fetchColumn() == 0) {
                $stmt->execute([$group['category'], $item[0], $item[1], $item[2]]);
                echo "Inserted: " . $item[0] . "\n";
            } else {
                echo "Skipped (exists): " . $item[0] . "\n";
            }
        }
    }
    
    echo "Setup completed successfully.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
