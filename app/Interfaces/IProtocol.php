<?php

namespace App\Interfaces;

interface IProtocol
{
    public function getAllProtols();

    public function getProtocolById($id);

    public function createProtocol(array $data);

    public function updateProtocol($id, array $data);

    public function deleteProtocol($id);
}
