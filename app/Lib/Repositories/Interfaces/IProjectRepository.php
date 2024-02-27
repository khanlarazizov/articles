<?php

namespace App\Lib\Repositories\Interfaces;

interface IProjectRepository
{
    public function getAllProject($companyId);

    public function getProjectById($companyId, $id);

    public function createProject($companyId, array $data);

    public function updateProject($companyId, array $data, $id);

    public function deleteProject($companyId, $id);

}
