<?php

namespace App\Repositories;

use App\Interfaces\IProject;
use App\Models\Project;
use App\Models\Company;

class ProjectRepository implements IProject
{

    public function getAllProject($companyId)
    {
        $company = Company::find($companyId);
        $projects = $company->projects();

        return $projects;
    }

    public function getProjectById($companyId, $id)
    {
        return Project::find($id);

    }

    public function createProject($companyId, array $data)
    {
        $company = Company::find($companyId);
        $project =  $company->projects()->create($data);
        return $project;
    }

    public function updateProject($companyId, array $data, $id)
    {
        return Project::find($id)->update($data);
    }

    public function deleteProject($companyId, $id)
    {
        Project::find($id)->delete();
    }
}
