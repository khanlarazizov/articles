<?php

namespace App\Lib\Repositories;

use App\Lib\Repositories\Interfaces\IDocumentRepository;
use App\Models\Document;

class DocumentRepository implements IDocumentRepository
{

    public function getAllDocuments()
    {
        return Document::all();
    }

    public function getDocumentById($id)
    {
        return Document::find($id);
    }

    public function createDocument(array $data)
    {
        return Document::create($data);
    }

    public function updateDocument($id, array $data)
    {
        return Document::find($id)->update($data);
    }

    public function deleteDocument($id)
    {
        Document::find($id)->delete();
    }
}
