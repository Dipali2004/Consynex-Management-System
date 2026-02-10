<?php
declare(strict_types=1);

namespace TrainingApp\App;

class Config
{
    public static function db(): array
    {
        return [
            // STEP 5: UPDATE THESE CREDENTIALS
            'dsn' => 'mysql:host=sqlXXX.infinityfree.com;port=3306;dbname=epiz_XXXXXX_training_app;charset=utf8mb4', 
            'user' => 'epiz_XXXXXX', 
            'pass' => 'YOUR_PANEL_PASSWORD', 
            'options' => [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ],
        ];
    }
}