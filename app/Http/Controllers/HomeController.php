<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;





class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function gallery() {
        return view('home');
    }
    public function getAuthId() {
        $id = Auth::user()->id;
        return response()->json([
            'id'=>$id
        ]);
    }
    public function getImages() {
        $id = Auth::user()->id;
        $images = Gallery::where('user_id','=',$id)->get();
        return response()->json([
            'data'=>$images
        ]);
    }
    public function deleteImage($id) {
        $image = Gallery::find($id);
        $filename = $image->image . "." . $image->type;

        $image_path = public_path().'/storage/image/'.$filename;
        unlink($image_path);

        $image->delete();

        return response()->json([
            "message"=>"deleted"
        ],202);
    }
}
