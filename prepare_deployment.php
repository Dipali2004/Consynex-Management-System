<?php
// Script to prepare deployment files
$sourceDir = __DIR__;
$targetDir = __DIR__ . '/deployment/htdocs';

if (is_dir($targetDir)) {
    // Basic cleanup - recursive delete
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($targetDir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($files as $fileinfo) {
        $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
        $todo($fileinfo->getRealPath());
    }
    rmdir($targetDir);
}

mkdir($targetDir, 0777, true);

function copyDir($src, $dst, $exclude = []) {
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..') && !in_array($file, $exclude)) {
            if (is_dir($src . '/' . $file)) {
                copyDir($src . '/' . $file, $dst . '/' . $file, $exclude);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

// 1. Copy Software-Services
echo "Copying Software-Services...\n";
copyDir($sourceDir . '/Software-Services', $targetDir . '/Software-Services', ['.git', 'node_modules', '.vscode', 'debug_log.txt', 'error_log.txt']);

// 2. Copy training
echo "Copying training...\n";
copyDir($sourceDir . '/training', $targetDir . '/training', ['.git', 'vendor']);

// 3. Create Sample Config
echo "Creating Sample Config...\n";
$sampleConfig = <<<PHP
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
PHP;
file_put_contents($targetDir . '/training/app/Config_Production.php', $sampleConfig);

echo "Deployment files ready in: deployment/htdocs\n";
