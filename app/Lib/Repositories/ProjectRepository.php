<?php

namespace App\Lib\Repositories;

use App\Lib\Exceptions\ModelNotFoundException;
use App\Lib\Repositories\Interfaces\IProjectRepository;
use App\Models\Company;
use App\Models\Project;

class ProjectRepository implements IProjectRepository
{

    public function getAllProject($companyId)
    {
        $company = Company::find($companyId);
        if($company == null)
            throw new ModelNotFoundException("Not Found");

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
