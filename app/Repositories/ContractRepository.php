<?php

namespace App\Repositories;

use App\Interfaces\IContract;
use App\Models\Contract;
use Illuminate\Support\Facades\Storage;

class ContractRepository implements IContract
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
        return Contract::find($id);
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







?>
