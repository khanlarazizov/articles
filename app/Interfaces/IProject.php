<?php

namespace App\Interfaces;

interface IProject
{
    public function getAllProject($companyId);

    public function getProjectById($companyId, $id);

    public function createProject($companyId, array $data);

    public function updateProject($companyId, array $data, $id);

    public function deleteProject($companyId, $id);

}
