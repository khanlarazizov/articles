<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contracts\StoreContractRequest;
use App\Http\Requests\Contracts\UpdateContractRequest;
use App\Lib\Exceptions\ModelNotFoundException;
use App\Lib\Repositories\Interfaces\IContractRepository;
use App\Lib\Repositories\Interfaces\IFolderRepository;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Log;

class ContractController extends Controller
{
    use FileUploadTrait;

    public $folder;
    public $contract;

    public function __construct(IFolderRepository $folder, IContractRepository $contract)
    {
        $this->folder = $folder;
        $this->contract = $contract;
    }

    public function index()
    {
        $contracts = $this->contract->getAllContracts()
            ->select(['id', 'name','file'])
            ->paginate(5);

        return view('documents.contract.index', compact('contracts'));
    }

    public function create()
    {
        $folders = $this->folder->folderAllTemporary();
        return view('documents.contract.create', compact('folders'));
    }

    public function store(StoreContractRequest $request)
    {
        dd($request->validated());


//        $other_type = $request->other_side_type_check == 'Fiziki şəxs' ? 'Fiziki şəxs' : $request->other_side_type;
//
//        $insert = $request->validated();
//        $insert['other_side_type'] = $other_type;
//        $insert['file'] = $this->storeFile($request, 'file', 'contracts');
//
//        $this->contract->createContract($insert);
//
//        $notification = array(
//            'message' => $request->name . " adlı müqavilə siyahıya uğurla əlavə edildi",
//            'alert-type' => 'success'
//        );
//
//        return redirect()->route('contracts.index')->with($notification);
    }

    public function show($id)
    {
        $contract = $this->contract->getContractById($id)->load('folder:id,name');

        return response()->json($contract);
    }

    public function edit($id)
    {
        try {
            $folders = $this->folder->folderAllTemporary();
            $contract = $this->contract->getContractById($id);
        }
        catch(ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return view("error.404", ['message' => $e->getMessage()]);
        }
        return view('documents.contract.edit', compact('contract', 'folders'));
    }

    public function update(UpdateContractRequest $request, $id)
    {
        $contract = $this->contract->getContractById($id);

        $other_type = $request->other_side_type_check == 'Fiziki şəxs' ? 'Fiziki şəxs' : $request->other_side_type;

        $insert = $request->validated();
        $insert['other_side_type'] = $other_type;
        $insert['file'] = $this->updateFile($request, 'file', $contract, 'contracts');

        $this->contract->updateContract($id, $insert);

        $notification = array(
            'message' => $request->name . " adlı müqavilə uğurla redaktə edildi",
            'alert-type' => 'success'
        );

        return redirect()->route('contracts.index')->with($notification);
    }

    public function destroy($id)
    {
        $this->contract->deleteContract($id);
    }
}
