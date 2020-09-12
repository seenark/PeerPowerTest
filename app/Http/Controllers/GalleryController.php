<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{

    public function store(Request $request) {

        // Pull max file size from .env file
        $MAX_SIZE = env("MAX_FILE_UPLOAD_SIZE", "2000");
        $id = Auth::user()->id;

        // // should have an image in request
        // $this->validate($request,[
        //     'files'=>"max:${$MAX_SIZE}"
        // ]);


            $total = $request->total;
            for ($i=0; $i < $total; $i++) {
                $fileNumber = "file{$i}";

                $file = $request->file($fileNumber);
                // Get file name with extension
                $filenameWithExtension = $file->getClientOriginalName();
                // split file name and extension
                $filename = pathinfo($filenameWithExtension,PATHINFO_FILENAME);
                // make filename unique with add the saved time
                $filename = $filename . "-" . time();
                // get extension
                $extension = $file->getClientOriginalExtension();
                // make filename with time add the extension to it for store in public folder
                $filenameToStore = $filename . "." . $extension;
                // get size for save to db
                $size = $file->getSize();
                // save to public folder
                $file->storeAs('public/image',$filenameToStore);

                // save other to database
                $image = new Gallery();
                $image->image = $filename;
                $image->type = $extension;
                $image->size = $size;
                $image->user_id = $id;
                $image->save();
            }
    }
}
