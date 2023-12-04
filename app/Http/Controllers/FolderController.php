<?php

namespace App\Http\Controllers;

use App\Http\Requests\Folders\StoreFolderRequest;
use App\Http\Requests\Folders\UpdateFolderRequest;
use App\Models\Contract;
use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index()
    {
        $folder = Folder::query()->
        get();
//        paginate(5);
        return view('folder.index', compact('folder'));
    }

    public function store(StoreFolderRequest $request)
    {
        Folder::create([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function edit(Folder $folder)
    {
        return response()->json($folder);
    }

    public function update(UpdateFolderRequest $request, Folder $folder)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:20'
        ], [
            'name.required' => 'Ad daxil edin.'
        ]);

        $folder->update([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Uğurlu'
        ]);
    }

    public function destroy(Folder $folder)
    {
        $folder->delete();
    }

    public function folder($id)
    {
        $contracts = Contract::with('protocols')->get();
        $folder = Folder::with('contracts')->where('id', $id)->first();

        return view('contract.index', compact('folder'));
    }
}
