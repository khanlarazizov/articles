<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class contractController extends Controller
{
    public function index()
    {
        $data = Contract::all();
        return view('contract.index', compact('data'));
    }

    public function fetch()
    {
        $contract = Contract::all();
        return response()->json([
            'contract' => $contract
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
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
            'type.required' => 'Tip daxil edin',
            'shopping.required' => 'nese daxil edin',
            'other_side_type.required' => 'Tip daxil edin',
            'other_side_name.required' => 'Təmsilçini daxil edin',
            'price.required' => 'Dəyər daxil edin',
            'tag.required' => 'Etiket daxil edin',
            'currency.required' => 'Ad daxil edin',
            'file.required' => 'Fayl daxil edin'
        ]);

        $file = $request->file('file');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/documents/contracts', $fileName);


        Contract::create([
            'name' => $request->name,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'type' => $request->type,
            'shopping' => $request->shopping,
            'other_side_type' => $request->other_side_type,
            'other_side_name' => $request->other_side_name,
            'price' => $request->price,
            'tag' => $request->tag,
            'currency' => $request->currency,
            'file' => $fileName

        ]);
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Uğurla əlavə edildi'
            ]
        );
    }

    public function edit($id)
    {
        $contract = Contract::find($id);
        return response()->json($contract);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
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
            'type.required' => 'Tip daxil edin',
            'shopping.required' => 'nese daxil edin',
            'other_side_type.required' => 'Tip daxil edin',
            'other_side_name.required' => 'Təmsilçini daxil edin',
            'price.required' => 'Dəyər daxil edin',
            'tag.required' => 'Etiket daxil edin',
            'currency.required' => 'Ad daxil edin',
            'file.required' => 'Fayl daxil edin'
        ]);

        $fileName = '';
        $contract = Contract::find($id);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/documents/contracts', $fileName);
            if ($contract->file) {
                Storage::delete('public/documents/contracts/' . $contract->file);
            }
        } else {
            $fileName = $request->file;
        }

        $contract->update([
            'name' => $request->name,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'type' => $request->type,
            'shopping' => $request->shopping,
            'other_side_type' => $request->other_side_type,
            'other_side_name' => $request->other_side_name,
            'price' => $request->price,
            'tag' => $request->tag,
            'currency' => $request->currency,
            'file' => $fileName

        ]);
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Uğurla əlavə edildi'
            ]
        );
    }

    public function delete($id)
    {
        $contract = Contract::find($id);
        if (Storage::delete('public/documents/contracts/' . $contract->file)) {
            Contract::destroy($id);
        }
    }
}
