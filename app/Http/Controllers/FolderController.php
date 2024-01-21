<?php

namespace App\Http\Controllers;

use App\Http\Requests\Folders\StoreFolderRequest;
use App\Http\Requests\Folders\UpdateFolderRequest;
use App\Interfaces\ICompany;
use App\Interfaces\IFolder;
use App\Interfaces\IProject;

class FolderController extends Controller
{
    public $folder;
    public $project;
    public $company;

    public function __construct(IFolder $folder, IProject $project, ICompany $company)
    {
        $this->folder = $folder;
        $this->project = $project;
        $this->company = $company;
    }

    public function index($companyId, $projectId)
    {
        $company = $this->company->getCompanyById($companyId);
        $project = $this->project->getProjectById($companyId, $projectId);
        $folders = $this->folder->getAllFolders($companyId, $projectId)->paginate(5);

        return view('folders.folder.index', compact('folders', 'company', 'project'));
    }

    public function store($companyId, $projectId, StoreFolderRequest $request)
    {
        $this->folder->createFolder($projectId, $request->validated());

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function edit($companyId, $projectId, $id)
    {
        $folder = $this->folder->getFolderById($id);

        return response()->json($folder);
    }

    public function update($companyId, $projectId, $id, UpdateFolderRequest $request)
    {
        $this->folder->updateFolder($id, $request->validated());

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function destroy($companyId, $projectId, $id)
    {
        $this->folder->deleteFolder($id);
    }
}
