<?php

namespace App\Http\Controllers;

use App\Http\Requests\Protocols\StoreProtocolRequest;
use App\Http\Requests\Protocols\UpdateProtocolRequest;
use App\Models\Contract;
use App\Models\Protocol;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProtocolController extends Controller
{
    use FileUploadTrait;

    public function index(Request $request)
    {
        $contracts = Contract::all();
        $protocols = Protocol::query()->with("contract:id,name")
            ->name($request->name)
            ->contract($request->contract_id)
            ->date($request->date)
            ->price($request->price)
            ->paginate(5);
        return view('documents.protocol.index', compact('protocols', 'contracts'));
    }

    public function create()
    {
        $contracts = Contract::all();
        return view('documents.protocol.create', compact('contracts'));
    }

    public function store(StoreProtocolRequest $request)
    {
        $insert = $request->validated();
        $insert['file'] = $this->storeFile($request, 'file', 'protocols');

        Protocol::create($insert);


        $notification = array(
            'message' => $request->name . " adlı protokol siyahıya uğurla əlavə edildi",
            'alert-type' => 'success'
        );

        return redirect()->route('protocols.index')->with($notification);
    }

    public function show(Protocol $protocol)
    {
        $protocol = Protocol::with('contract:id,name')->find($protocol->id);
        return response()->json($protocol);
    }

    public function edit(Protocol $protocol)
    {
        $contracts = Contract::all();
        return view('documents.protocol.edit', compact('protocol', 'contracts'));
    }

    public function update(UpdateProtocolRequest $request, Protocol $protocol)
    {
        $insert = $request->validated();
        $insert['file'] = $this->updateFile($request, 'file', $protocol, 'protocols');
        $protocol->update($insert);

        $notification = array(
            'message' => $request->name . " adlı protokol uğurla redaktə edildi",
            'alert-type' => 'success'
        );

        return redirect()->route('protocols.index')->with($notification);
    }

    public function destroy(Protocol $protocol)
    {
        if (Storage::delete('public/documents/protocols/' . $protocol->file)) {
            $protocol->delete();
        }
    }

    public function download(Protocol $protocol)
    {
        return Storage::download('public/documents/protocols/' . $protocol->file);
    }
}
