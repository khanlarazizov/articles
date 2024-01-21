<?php

namespace App\Interfaces;

interface IFolder
{
    public function getAllFolders($companyId, $projectId);

    public function getFolderById($id);

    public function createFolder($projectId, array $data);

    public function updateFolder($id, array $data);

    public function deleteFolder($id);

    public function folderAllTemporary();
}
