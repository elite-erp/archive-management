<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search', '');
        $documents = fetchDocuments($search);
        return Inertia::render('documents/index', compact('documents', 'search'));
    }
    /**
     * create
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('label', 'id')->get();
        return Inertia::render('documents/register', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            'title' => 'required|max:191',
            'description' => 'required',
            'category_id' => 'required|numeric|exists:categories,id',
            "attachments.*" => "required|file|mimes:jpeg,png,jpg|max:20000"
        ]);

        $data['created_by'] = $data['updated_by'] = auth()->id();

        $document = Document::create($data);

        if (request()->hasFile('attachments')) {
            foreach (request()->file('attachments') as $attachment) {
                $name = $attachment->getClientOriginalName();
                $path = '/' . $attachment->storeAs('uploads/attachments', $name);
                Attachment::create([
                    'path' => $path,
                    'created_by' => auth()->id(),
                    'document_id' => $document->id
                ]);
            }
        }


        return to_route('documents.show', $document->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $document->load('attachments');
        $document->load('category');

        return Inertia::render('documents/show', compact('document'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPrint($id)
    {
        $document = Document::find($id)->load('attachments');

        return Inertia::render('documents/show-print', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:191',
            'description' => 'required',
            'catgory' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {

            if ($document) {
                $document->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'catgory' => $request->catgory
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Document Updated Successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something Went Wrong'
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->delete();
        return [
            'status' => 'OK',
            'message' => 'Document Deleted Successfully'
        ];
    }

    public function restore(Document $document){
        $document->withTrashed()->restore() ;
        return [
            'status' => 'OK',
            'message' => 'Document Restored Successfully'
        ];
    }
}
