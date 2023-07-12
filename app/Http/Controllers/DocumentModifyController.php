<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentModifyController extends Controller
{
    //
    public function view() {
        return view("view-pdf");
    }

    public function UploadPDF(Request $request) {
        $file = $request->file('file_pdf');
   
        if(!in_array('pdf', [$file->getClientOriginalExtension()])) {
            return response()->json(['success' => false, 'data' => '', 'messages' => 'Only recive file PDF']);
        }
        //Move Uploaded File
        $destinationPath = 'public/files';
        $file->move($destinationPath,$file->getClientOriginalName());
        return response()->json(['success' => true, 'data' => url('public/files/'.$file->getClientOriginalName()), 'messages' => 'Upload success']);
    }
}
