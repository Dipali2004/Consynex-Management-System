<?php
declare(strict_types=1);

namespace TrainingApp\App;

class Router
{
    public static function path(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $qPos = strpos($uri, '?');
        if ($qPos !== false) {
            $uri = substr($uri, 0, $qPos);
        }
        return rtrim($uri, '/') ?: '/';
    }

    public static function segments(): array
    {
        $p = self::path();
        
        // Handle subfolder routing logic
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $scriptDir = dirname($scriptName);
        
        // Remove script directory from URI if present
        if ($scriptDir !== '/' && strpos($p, $scriptDir) === 0) {
            $p = substr($p, strlen($scriptDir));
        }
        
        return ($p === '' || $p === '/') ? [] : explode('/', ltrim($p, '/'));
    }
}

