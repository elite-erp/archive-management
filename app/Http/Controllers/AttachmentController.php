<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attachment;

class AttachmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'document_id' => 'required|numeric|exists:documents,id',
            "attachments.*" => "required|file|mimes:jpeg,png,jpg|max:20000"
        ]);

        foreach (request()->file('attachments') as $attachment) {
            $name = $attachment->getClientOriginalName();
            $path = '/' . $attachment->storeAs('uploads/attachments', $name);
            Attachment::create([
                'path' => $path,
                'document_id' => request('document_id'),
                'created_by' => auth()->id()
            ]);
        }


        return to_route('documents.show', request('document_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attachment = Attachment::find($id);
        $attachment->delete();

        return to_route('documents.show', $attachment->document_id);
    }
}
