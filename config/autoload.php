<?php

spl_autoload_register(static function (string $class): void {
    $filePath = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
        return;
    }

    $root = __DIR__ . '/..';
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $baseName = $file->getBasename('.php');
            if ($baseName === $class) {
                require_once $file->getPathname();
                return;
            }
        }
    }
});