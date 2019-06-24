<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 14.06.19
 * Time: 20:21
 */

namespace document;


interface DocumentInterface
{
    public function addDocumentItem(DocumentElementInterface $documentItem, ?int $index) : void;
    public function getItemsCount() : int;
    public function getItem(int $index) : ?DocumentElementInterface;
    public function getItems() : array;
    public function deleteItem(int $index) : void;
    public function getTitle() : string;
    public function setTitle(string $title) : void;
}