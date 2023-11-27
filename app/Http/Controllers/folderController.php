<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Folder;
use Illuminate\Http\Request;

class folderController extends Controller
{
    public function index()
    {
        $folder = Folder::query()->paginate(5);
        return view('folder.index',compact('folder'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:3|max:20'
        ],[
            'name.required'=>'Ad daxil edin.'
        ]);

        Folder::create([
            'name'=>$request->name
        ]);

        return response()->json([
            'status'=>'success'
        ]);
    }

    public function edit($id)
    {
        $folders = Folder::find($id);
        return response()->json($folders);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name'=>'required|min:3|max:20'
        ],[
            'name.required'=>'Ad daxil edin.'
        ]);

        $folder = Folder::find($id);

        $folder->update([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Uğurlu'
        ]);
    }

    public function delete($id)
    {
        Folder::find($id)->delete();
    }

    public function folder($id)
    {
        $contracts = Contract::with('protocols')->get();
        $folder = Folder::with('contracts')->where('id',$id)->first();

        return view('contract.index',compact('folder'));
    }
}
