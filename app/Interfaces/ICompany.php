<?php

namespace App\Interfaces;


interface ICompany
{
    public function getAllCompanies();

    public function getCompanyById($id);

    public function createCompany(array $data);

    public function updateCompany($id, array $data);

    public function deleteCompany($id);
}


