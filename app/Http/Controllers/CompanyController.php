<?php

namespace App\Http\Controllers;

use App\Http\Requests\Companies\StoreCompanyRequest;
use App\Http\Requests\Companies\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $companies = Company::with('projects')
            ->select('id', 'name')
            ->paginate(5);

        return view('folders.company.index', compact('companies', 'projects'));
    }

    public function store(StoreCompanyRequest $request)
    {
        Company::create($request->validated());

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function edit(Company $company)
    {
        return response()->json($company);
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function destroy(Company $company)
    {
        $company->delete();
    }
}
