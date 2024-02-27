<?php

namespace App\Lib\Repositories;

use App\Lib\Repositories\Interfaces\ICompanyRepository;
use App\Models\Company;

class CompanyRepository implements ICompanyRepository
{
    public function getAllCompanies()
    {
        return Company::with('projects');
    }

    public function getCompanyById($id)
    {
        return Company::find($id);
    }

    public function createCompany(array $data)
    {
        return Company::create($data);
    }

    public function updateCompany($id, array $data)
    {
        return Company::find($id)->update($data);
    }

    public function deleteCompany($id)
    {
        Company::find($id)->delete();
    }
}

