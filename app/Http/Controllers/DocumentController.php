<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::with('attachments')->orderBy('id','DESC')->paginate(10);
        if ($documents->count() > 0) {
            return response()->json([
                    'status' => 200,
                    'documents' => $documents
                ],200);
        }
        else {
            return response()->json([
                    'status' => 404,
                    'message' => 'No Records Found'
                ],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:191',
            'description' => 'required',
            'catgory' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422 ,
                'error' => $validator->messages()
            ],422) ;
        }else{
            $document = Document::create([
                'title' => $request->title ,
                'description' => $request->description,
                'catgory' => $request->catgory
            ]);
            if ($document) {
                return response()->json([
                    'status' => 200 ,
                    'message' => 'Document Created Successfully'
                ],200);
            } else{
                return response()->json([
                    'status' => 500 ,
                    'message' => 'Something Went Wrong'
                ],500);
            }
            
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        if ($document) {
            return response()->json([
                'status' => 200,
                'document' => $document
            ],200);
        }else{
            return response()->json([
                        'status' => 404,
                        'message' => 'No such Document Found'
                    ],404);
        }
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
                'status' => 422 ,
                'error' => $validator->messages()
            ],422) ;
        }else{
            
            if ($document) {
                $document->update([
                    'title' => $request->title ,
                    'description' => $request->description,
                    'catgory' => $request->catgory
                ]);
                
                return response()->json([
                    'status' => 200 ,
                    'message' => 'Document Updated Successfully'
                ],200);
            } else{
                return response()->json([
                    'status' => 500 ,
                    'message' => 'Something Went Wrong'
                ],500);
            }
            
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
