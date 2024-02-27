<?php

namespace App\Http\Controllers;

use App\Http\Requests\Documents\StoreDocumentRequest;
use App\Lib\Repositories\Interfaces\IDocumentRepository;
use App\Models\Contract;
use App\Models\Document;
use App\Models\DocumentDetail;
use App\Models\Folder;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Comment\Doc;

class DocumentController extends Controller
{
//    public $document;
//
//    public function __construct(IDocumentRepository $document)
//    {
//        $this->document = $document;
//    }

    use FileUploadTrait;

    public function index()
    {
        $documents = Document::all();

        return view('_documents.index', compact('documents'));
    }

    public function createContract()
    {
        $folders = Folder::all();
        return view('_documents.contract.create', compact('folders'));
    }

    public function createProtocol()
    {
        $folders = Folder::all();
        $contracts = Document::where('document_type', '=', 'Müqavilə')->select('number', 'id')->get();
        return view('_documents.protocol.create', compact('contracts', 'folders'));
    }

    public function createContractAddition()
    {
        $folders = Folder::all();
        $contracts = Document::where('document_type', '=', 'Müqavilə')->select('number', 'id')->get();
        return view('_documents.contract-addition.create', compact('contracts', 'folders'));
    }

    public function createDeliveryStatement(Request $request)
    {
        $folders = Folder::all();
        $contracts = Document::with('documentDetail')
            ->where('document_type', 'Müqavilə')
            ->get();

        return view('_documents.delivery-statement.create', compact('folders', 'contracts'));
    }

    public function getAddition(Request $request)
    {
        $documents = DB::table('documents')
            ->leftjoin('document_details', 'documents.id', '=', 'document_details.document_id');

        $additions = $documents
            ->where('contract_id', $request->contract_id)
            ->where('document_type', '!=', 'Təhvil-təslim aktı')
            ->get();

        return response()->json([
            'additions' => $additions
        ]);
    }


    public function store(Request $request)
    {
//        dd($request->all());
        try {
            DB::beginTransaction();

            $document = Document::create([
                'number' => $request->number,
                'document_type' => $request->document_type,
                'date' => $request->date,
                'folder_id' => $request->folder_id,
                'currency' => $request->currency,
                'price' => $request->price,
                'tag' => $request->tag,
                'file' => $this->storeFile($request, 'file', 'newdocuments'),
            ]);

            DocumentDetail::create([
                'document_id' => $document->id,
                'contract_id' => $request->contract_id,
                'addition_id' => $request->addition_id,
                'contract_type' => $request->contract_type,
                'shopping' => $request->shopping,
                'other_side_type' => $request->other_side_type,
                'other_side_name' => $request->other_side_name,
                'product_service_name' => $request->product_service_name,
                'product_service_number_integer' => $request->product_service_number_integer,
                'product_service_number_string' => $request->product_service_number_string,
            ]);
            DB::commit();
        } catch (\Exception $exception) {
//            report($exception);
//            DB::rollBack();

            dd($exception);
        }

        $notification = array(
            'message' => $request->number . " nömrəli sənəd siyahıya uğurla əlavə edildi",
            'alert-type' => 'success'
        );

        return redirect()->route('documents.index')->with($notification);
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        $document = Document::find($id);

        if (Storage::delete('public/documents/newdocuments/' . $document->file)) {
            $document->delete();
        }
    }
}
