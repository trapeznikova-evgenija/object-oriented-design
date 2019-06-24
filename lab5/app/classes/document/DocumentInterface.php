<?php

namespace document;


interface DocumentInterface
{
    public function addDocumentItem(DocumentElement $documentItem, ?int $index) : void;
    public function getItemsCount() : int;
    public function getItem(int $index) : ?DocumentElement;
    public function getItems() : array;
    public function deleteItem(int $index) : void;
    public function getTitle() : string;
    public function setTitle(string $title) : void;
}