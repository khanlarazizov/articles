<?php

namespace App\Lib\Repositories\Interfaces;

interface  IContractRepository
{
    public function getAllContracts();

    public function getContractWithAttributes();

    public function getContractById($id);

    public function createContract(array $data);

    public function updateContract($id, array $data);

    public function deleteContract($id);
}

