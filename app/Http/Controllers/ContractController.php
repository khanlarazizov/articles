<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contracts\StoreContractRequest;
use App\Http\Requests\Contracts\UpdateContractRequest;
use App\Models\Contract;
use App\Models\Folder;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $contracts = Contract::with('protocols:id,name')->select(['id', 'name'])
            ->paginate(5);
        return view('documents.contract.index', compact('contracts'));
    }

    public function create()
    {
        $folders = Folder::all();
        return view('documents.contract.create', compact('folders'));
    }

    public function store(StoreContractRequest $request)
    {
        $other_type = $request->other_side_type_check == 'Fiziki şəxs' ? 'Fiziki şəxs' : $request->other_side_type;

        $insert = $request->validated();
        $insert['other_side_type'] = $other_type;
        $insert['file'] = $this->storeFile($request, 'file', 'contracts');

        Contract::create($insert);

        $notification = array(
            'message' => $request->name . " adlı müqavilə siyahıya uğurla əlavə edildi",
            'alert-type' => 'success'
        );

        return redirect()->route('contracts.index')->with($notification);
    }

    public function show(string $id)
    {
        $contract = Contract::with('folder:id,name')->find($id);
        return response()->json($contract);
    }

    public function edit(Contract $contract)
    {
        $folders = Folder::all();
        return view('documents.contract.edit', compact('contract', 'folders'));
    }

    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $other_type = $request->other_side_type_check == 'Fiziki şəxs' ? 'Fiziki şəxs' : $request->other_side_type;

        $insert = $request->validated();
        $insert['other_side_type'] = $other_type;
        $insert['file'] = $this->updateFile($request, 'file', $contract, 'contracts');

        $contract->update($insert);


        $notification = array(
            'message' => $request->name . " adlı müqavilə uğurla redaktə edildi",
            'alert-type' => 'success'
        );

        return redirect()->route('contracts.index')->with($notification);
    }

    public function destroy(Contract $contract)
    {
        if (Storage::delete('public/documents/contracts/' . $contract->file)) {
            $contract->delete();
        }
    }

    public function download(Contract $contract)
    {
        return Storage::download('public/documents/contracts/' . $contract->file);
    }
}
