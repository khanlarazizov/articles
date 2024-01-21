<?php

namespace App\Http\Controllers;

use App\Http\Requests\Protocols\StoreProtocolRequest;
use App\Http\Requests\Protocols\UpdateProtocolRequest;
use App\Interfaces\IContract;
use App\Interfaces\IProtocol;
use App\Models\Contract;
use App\Models\Protocol;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProtocolController extends Controller
{
    use FileUploadTrait;

    public $protocol;
    public $contract;

    public function __construct(IProtocol $protocol, IContract $contract)
    {
        $this->protocol = $protocol;
        $this->contract = $contract;
    }

    public function index(Request $request)
    {
        $contracts = $this->contract->getAllContracts()->get();

        $protocols = $this->protocol->getAllProtols()
            ->name($request->name)
            ->contract($request->contract_id)
            ->date($request->date)
            ->price($request->price)
            ->paginate(5);
        return view('documents.protocol.index', compact('protocols', 'contracts'));
    }

    public function create()
    {
        $contracts = $this->contract->getContractWithAttributes();

        return view('documents.protocol.create', compact('contracts'));
    }

    public function store(StoreProtocolRequest $request)
    {
        $insert = $request->validated();
        $insert['file'] = $this->storeFile($request, 'file', 'protocols');

        $this->protocol->createProtocol($insert);

        $notification = array(
            'message' => $request->name . " adlı protokol siyahıya uğurla əlavə edildi",
            'alert-type' => 'success'
        );

        return redirect()->route('protocols.index')->with($notification);
    }

    public function show($id)
    {
        $protocol = $this->protocol->getProtocolById($id)->load('contract:id,name');
        return response()->json($protocol);
    }

    public function edit($id)
    {
        $contracts = $this->contract->getContractWithAttributes();
        $protocol = $this->protocol->getProtocolById($id);
//        dd($protocol);
        return view('documents.protocol.edit', compact('protocol', 'contracts'));
    }

    public function update(UpdateProtocolRequest $request, $id)
    {
        $protocol = $this->protocol->getProtocolById($id);

        $insert = $request->validated();
        $insert['file'] = $this->updateFile($request, 'file', $protocol, 'protocols');

        $this->protocol->updateProtocol($id, $insert);

        $notification = array(
            'message' => $request->name . " adlı protokol uğurla redaktə edildi",
            'alert-type' => 'success'
        );

        return redirect()->route('protocols.index')->with($notification);
    }

    public function destroy($id)
    {
        $this->protocol->deleteProtocol($id);
    }
}
