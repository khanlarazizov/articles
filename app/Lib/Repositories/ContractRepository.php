<?php

namespace App\Lib\Repositories;

use App\Lib\Exceptions\ModelNotFoundException;
use App\Lib\Repositories\Interfaces\IContractRepository;
use App\Models\Contract;
use Illuminate\Support\Facades\Storage;

class ContractRepository implements IContractRepository
{

    public function getAllContracts()
    {
        return Contract::with('protocols:id,name');
    }

    public function getContractWithAttributes()
    {
        return Contract::select(['id','name'])->get();
    }

    public function getContractById($id)
    {
        $contract = Contract::find($id);
        if($contract == null)
            throw new ModelNotFoundException("Not Found");
        return $contract;
    }

    public function createContract(array $data)
    {
        return Contract::create($data);
    }

    public function updateContract($id, array $data)
    {
        return Contract::find($id)->update($data);
    }

    public function deleteContract($id)
    {
        $contract = Contract::find($id);

        if (Storage::delete('public/documents/contracts/' . $contract->file)) {
            $contract->delete();
        }
    }

}
