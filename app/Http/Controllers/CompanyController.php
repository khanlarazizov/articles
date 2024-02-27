<?php

namespace App\Http\Controllers;

use App\Http\Requests\Companies\StoreCompanyRequest;
use App\Http\Requests\Companies\UpdateCompanyRequest;
use App\Lib\Repositories\Interfaces\ICompanyRepository;

class CompanyController extends Controller
{
    public $company;

    public function __construct(ICompanyRepository $company)
    {
        $this->company = $company;
    }

    public function index()
    {
        $companies = $this->company->getAllCompanies()->select('id', 'slug', 'name')->paginate(5);;

        return view('folders.company.index', compact('companies'));
    }

    public function store(StoreCompanyRequest $request)
    {
        $this->company->createCompany($request->validated());

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function edit($id)
    {
        $company = $this->company->getCompanyById($id);
        return response()->json($company);
    }

    public function update($id, UpdateCompanyRequest $request)
    {
        $this->company->updateCompany($id, $request->validated());

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $this->company->deleteCompany($id);
    }

}
