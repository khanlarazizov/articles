<?php

namespace App\Http\Controllers;

use App\Http\Requests\Protocols\StoreProtocolRequest;
use App\Http\Requests\Protocols\UpdateProtocolRequest;
use App\Models\Contract;
use App\Models\Protocol;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class protocolController extends Controller
{
    public function index(Request $request)
    {
        $contracts = Contract::all();
        $protocols = Protocol::query()->with("contract:id,name")
            ->name($request->name)
            ->contract($request->contract_id)
            ->date($request->date)
            ->price($request->price)
            ->paginate(5);
        return view('protocol.index', compact('protocols', 'contracts'));
    }

    public function create()
    {
        $contracts = Contract::all();
        return view('protocol.create', compact('contracts'));
    }

    public function store(StoreProtocolRequest $request)
    {
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/documents/protocols', $fileName);
        }

        Protocol::create([
            'name' => $request->name,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'contract_id' => $request->contract_id,
            'other_side_name' => $request->other_side_name,
            'price' => $request->price,
            'currency' => $request->currency,
            'tag' => $request->tag,
            'file' => $fileName
        ]);

        $notification = array(
            'message' => $request->name." adlı protokol siyahıya uğurla əlavə edildi" ,
            'alert-type' => 'success'
        );

        return redirect()->route('protocol.index')->with($notification);
    }

    public function edit($id)
    {
        $protocol = Protocol::find($id);
        $contracts = Contract::all();
        return view('protocol.edit',compact('protocol','contracts'));
    }

    public function update(UpdateProtocolRequest $request,$id)
    {
        $protocol = Protocol::find($id);

        $fileName = '';
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/documents/protocols', $fileName);
            if ($protocol->file) {
                Storage::delete('public/documents/protocols/' . $protocol->file);
            }
        } else {
            $fileName = $protocol->file;
        }

        $protocol->update([
            'name' => $request->name,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'contract_id' => $request->contract_id,
            'other_side_name' => $request->other_side_name,
            'price' => $request->price,
            'currency' => $request->currency,
            'tag' => $request->tag,
            'file' => $fileName
        ]);

        $notification = array(
            'message' => $request->name." adlı protokol uğurla redaktə edildi" ,
            'alert-type' => 'success'
        );

        return redirect()->route('protocol.index')->with($notification);
    }

    public function delete(string $id)
    {
        $protocol = Protocol::find($id);
        if (Storage::delete('public/documents/protocols/' . $protocol->file)) {
            Protocol::destroy($id);
        }
    }

    public function download($id)
    {
        $protocol= Protocol::find($id);
        return Storage::download('public/documents/protocols/' . $protocol->file);
    }
}
