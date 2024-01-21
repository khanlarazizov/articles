<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\StoreProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;
use App\Interfaces\ICompany;
use App\Interfaces\IProject;

class ProjectController extends Controller
{

    public $project;
    public $company;

    public function __construct(IProject $project, ICompany $company)
    {
        $this->project = $project;
        $this->company = $company;
    }

    public function index($companyId)
    {
        $company = $this->company->getCompanyById($companyId);
        $projects = $this->project->getAllProject($companyId)->paginate(5);

        return view('folders.project.index', compact('projects', 'company'));
    }

    public function edit($companyId, $id)
    {
        $project = $this->project->getProjectById($companyId, $id);
        return response()->json($project);
    }

    public function store($companyId, StoreProjectRequest $request)
    {
        $this->project->createProject($companyId, $request->validated());

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function update($companyId, UpdateProjectRequest $request, $id)
    {
        $this->project->updateProject($companyId, $request->validated(), $id);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function destroy($companyId, $id)
    {
        $this->project->deleteProject($companyId, $id);
    }
}
