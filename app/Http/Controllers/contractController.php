<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contracts\StoreContractRequest;
use App\Http\Requests\Contracts\UpdateContractRequest;
use App\Models\Contract;
use App\Models\Folder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class contractController extends Controller
{
    public function index()
    {
        $contracts = Contract::query()->with('protocols:id,name')->paginate(5);
        return view('contract.index', compact('contracts'));
    }

    public function create()
    {
        $folders = Folder::all();
        return view('contract.create',compact('folders'));
    }
    public function store(StoreContractRequest $request)
    {
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/documents/contracts', $fileName);
        }

        Contract::create([
            'name' => $request->name,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'folder_id' => $request->folder_id,
            'type' => $request->type,
            'shopping' => $request->shopping,
            'other_side_type' => $request->other_side_type,
            'other_side_name' => $request->other_side_name,
            'price' => $request->price,
            'tag' => $request->tag,
            'currency' => $request->currency,
            'file' => $fileName
        ]);

        $notification = array(
            'message' => $request->name." adlı müqavilə siyahıya uğurla əlavə edildi" ,
            'alert-type' => 'success'
        );

        return redirect()->route('contract.index')->with($notification);
    }

    public function edit(string $id)
    {
        $contract = Contract::find($id);
        $folders = Folder::all();
        return view('contract.edit',compact('contract','folders'));
    }

    public function update(UpdateContractRequest $request,string $id)
    {
        $contract = Contract::find($id);

        $fileName = '';
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/documents/contracts', $fileName);
            if ($contract->file) {
                Storage::delete('public/documents/contracts/' . $contract->file);
            }
        } else {
            $fileName = $contract->file;
        }

        $contract->update([
            'name' => $request->name,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'folder_id' => $request->folder_id,
            'type' => $request->type,
            'shopping' => $request->shopping,
            'other_side_type' => $request->other_side_type,
            'other_side_name' => $request->other_side_name,
            'price' => $request->price,
            'tag' => $request->tag,
            'currency' => $request->currency,
            'file' => $fileName
        ]);

        $notification = array(
            'message' => $request->name." adlı müqavilə uğurla redaktə edildi" ,
            'alert-type' => 'success'
        );

        return redirect()->route('contract.index')->with($notification);
    }

    public function delete(string $id)
    {
        $contract = Contract::find($id);
        if (Storage::delete('public/documents/contracts/' . $contract->file)) {
            $contract->destroy($id);
        }
    }

    public function download(string $id)
    {
        $contract = Contract::find($id);
        return Storage::download('public/documents/contracts/' . $contract->file);
    }
}
