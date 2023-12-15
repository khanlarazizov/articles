<?php

namespace App\Http\Controllers;

use App\Http\Requests\Folders\StoreFolderRequest;
use App\Http\Requests\Folders\UpdateFolderRequest;
use App\Models\Company;
use App\Models\Contract;
use App\Models\Folder;
use App\Models\Project;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index(Company $company, Project $project)
    {
        $projects = Project::all();

        $folders = $project->folders()
            ->with('project:id,name')
            ->paginate(5);

        return view('folders.folder.index', compact('folders', 'project', 'projects'));
    }

    public function store(StoreFolderRequest $request, Company $company, Project $project)
    {
        $project->folders()->create($request->validated());

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function edit(Company $company, Project $project, Folder $folder)
    {
        return response()->json($folder);
    }


    public function update(Company $company, Project $project, UpdateFolderRequest $request, Folder $folder)
    {

        $folder->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Uğurlu'
        ]);
    }

    public function destroy(Company $company, Project $project, Folder $folder)
    {
        $folder->delete();
    }

//    public function folder($id)
//    {
//        $contracts = Contract::with('protocols')->get();
//        $folder = Folder::with('contracts')->where('id', $id)->first();
//
//        return view('documents.contract.index', compact('folder'));
//    }
}
