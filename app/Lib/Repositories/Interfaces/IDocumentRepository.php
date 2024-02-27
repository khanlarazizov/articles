<?php

namespace App\Lib\Repositories\Interfaces;


interface IDocumentRepository
{
    public function getAllDocuments();

    public function getDocumentById($id);

    public function createDocument(array $data);

    public function updateDocument($id, array $data);

    public function deleteDocument($id);
}
