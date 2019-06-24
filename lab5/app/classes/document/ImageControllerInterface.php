<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 24.06.19
 * Time: 4:44
 */

namespace document;


interface ImageControllerInterface
{
    public function addImage(string $path) : string;
    public function markAsDeleted(string $path) : void;
    public function unmarkAsDeleted(string $path) : void;
    public function deleteImageWhichMarkAsDeleted() : void;
    public function copyFilesToDirectory(string $path) : void;
}