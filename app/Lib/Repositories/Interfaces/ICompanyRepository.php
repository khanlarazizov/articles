<?php

namespace App\Lib\Repositories\Interfaces;


interface ICompanyRepository
{
    public function getAllCompanies();

    public function getCompanyById($id);

    public function createCompany(array $data);

    public function updateCompany($id, array $data);

    public function deleteCompany($id);
}


