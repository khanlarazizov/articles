<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Folder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class contractController extends Controller
{
    public function index()
    {
        $contracts = Contract::query()->with('protocols')->paginate(5);
        return view('contract.index', compact('contracts'));
    }

    public function create()
    {
        $folders = Folder::all();
        return view('contract.create',compact('folders'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
            'folder_id'=>'required',
            'type' => 'required',
            'shopping' => 'required',
            'other_side_type' => 'required',
            'other_side_name' => 'required',
            'price' => 'required',
            'tag' => 'required',
            'currency' => 'required',
            'file' => 'required|mimes:pdf'
        ], [
            'name.required' => 'Ad daxil edin',
            'date.required' => 'Tarix daxil edin',
            'folder_id.required' => 'Qovluq daxil edin',
            'type.required' => 'Tip daxil edin',
            'shopping.required' => 'nese daxil edin',
            'other_side_type.required' => 'Tip daxil edin',
            'other_side_name.required' => 'Təmsilçini daxil edin',
            'price.required' => 'Dəyər daxil edin',
            'tag.required' => 'Etiket daxil edin',
            'currency.required' => 'Ad daxil edin',
            'file.required' => 'Fayl daxil edin'
        ]);

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

    public function update(Request $request,string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
            'folder_id'=>'required',
            'type' => 'required',
            'shopping' => 'required',
            'other_side_type' => 'required',
            'other_side_name' => 'required',
            'price' => 'required',
            'tag' => 'required',
            'currency' => 'required',
//            'file' => 'required|mimes:pdf'
        ], [
            'name.required' => 'Ad daxil edin',
            'date.required' => 'Tarix daxil edin',
            'folder_id.required' => 'Qovluq daxil edin',
            'type.required' => 'Tip daxil edin',
            'shopping.required' => 'nese daxil edin',
            'other_side_type.required' => 'Tip daxil edin',
            'other_side_name.required' => 'Təmsilçini daxil edin',
            'price.required' => 'Dəyər daxil edin',
            'tag.required' => 'Etiket daxil edin',
            'currency.required' => 'Ad daxil edin',
//            'file.required' => 'Fayl daxil edin'
        ]);


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
            Contract::destroy($id);
        }
    }

    public function download(string $id)
    {
        $contract = Contract::find($id);
        return Storage::download('public/documents/contracts/' . $contract->file);
    }
}
