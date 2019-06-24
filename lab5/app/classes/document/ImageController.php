<?php

namespace document;

use InvalidArgumentException;

class ImageController implements ImageControllerInterface
{
    /** @var string */
    private $directoryPath;
    /** @var array */
    private $files;

    public function __construct(string $path)
    {
        if (!is_dir($path))
        {
            mkdir($path, 0777, true);
        }
        $this->directoryPath = $path;
        $this->files = [];
    }

    public function __destruct()
    {
        if (is_dir($this->directoryPath))
        {
            rmdir($this->directoryPath);
        }
    }

    public function addImage(string $path): string
    {
        if (!file_exists($path))
        {
            throw new InvalidArgumentException('Files isn\'t exits.');
        }

        $newPath = $this->directoryPath . '/' . uniqid('image') . '.' . pathinfo($path, PATHINFO_EXTENSION);
        $this->copy($path, $newPath);
        $this->files[$newPath] = true;
        return $newPath;
    }

    public function markAsDeleted(string $path): void
    {
        $this->files[$path] = false;
    }

    public function unmarkAsDeleted(string $path): void
    {
        if (isset($this->files[$path]))
        {
            $this->files[$path] = true;
        }
    }

    public function deleteImageWhichMarkAsDeleted(): void
    {
        foreach ($this->files as $path => $value)
        {
            unset($this->files[$path]);
            $this->deleteFile($path);
        }
    }

    public function copyFilesToDirectory(string $path): void
    {
        if (is_dir($path))
        {
            foreach ($this->files as $filePath => $isExits)
            {
                if ($isExits)
                {
                    $this->copy($filePath, $path);
                }
            }
        }
    }

    private function copy(string $fromPath, string $toPath): void
    {
        copy($fromPath, $toPath);
    }

    private function deleteFile(string $path): void
    {
        if (file_exists($path))
        {
            unlink($path);
        }
    }
}