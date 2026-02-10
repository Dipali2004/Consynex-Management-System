<?php
namespace TrainingApp\App\Models;

use TrainingApp\App\Database;
use PDO;

class ServiceRequest
{
    public static function create(array $data)
    {
        $pdo = Database::conn();
        // Map 'name' to 'customer_name' to match existing table schema
        $sql = "INSERT INTO service_requests (service_name, customer_name, mobile, email, message) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['service_name'],
            $data['name'],
            $data['mobile'],
            $data['email'],
            $data['message']
        ]);
        return $pdo->lastInsertId();
    }

    public static function getAll()
    {
        $pdo = Database::conn();
        $stmt = $pdo->query("SELECT * FROM service_requests ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
