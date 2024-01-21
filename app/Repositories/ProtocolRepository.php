<?php

namespace App\Repositories;

use App\Interfaces\IProtocol;
use App\Models\Protocol;
use Illuminate\Support\Facades\Storage;

class ProtocolRepository implements IProtocol
{

    public function getAllProtols()
    {
        return Protocol::query()->with("contract:id,name");
    }

    public function getProtocolById($id)
    {
        return Protocol::find($id);
    }

    public function createProtocol(array $data)
    {
        return Protocol::create($data);
    }

    public function updateProtocol($id, array $data)
    {
        return Protocol::find($id)->update($data);
    }

    public function deleteProtocol($id)
    {
        $protocol = Protocol::find($id);

        if (Storage::delete('public/documents/protocols/' . $protocol->file)) {
            $protocol->delete();
        }
    }
}
