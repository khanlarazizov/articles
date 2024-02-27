<?php

namespace App\Lib\Repositories;

use App\Lib\Repositories\Interfaces\IFolderRepository;
use App\Models\Folder;
use App\Models\Project;

class FolderRepository implements IFolderRepository
{
    public function getAllFolders($companyId, $projectId)
    {
        $project = Project::find($projectId);
        $folders = $project->folders();

        return $folders;
    }

    public function getFolderById($id)
    {
        return Folder::find($id);
    }

    public function createFolder($projectId, array $data)
    {
        $project = Project::find($projectId);
        $folder = $project->folders()->create($data);

        return $folder;
    }

    public function updateFolder($id, array $data)
    {
        return Folder::find($id)->update($data);
    }

    public function deleteFolder($id)
    {
        Folder::find($id)->delete();
    }

    public function folderAllTemporary()
    {
        return Folder::all();
    }
}
