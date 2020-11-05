<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::where('user_id', auth()->user()->id)->where('success', 'true')->get();
        return view('downloads.index', compact('links'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Descarga el video.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($symbolicLink)
    {
            $video_path = 'videos/' . $symbolicLink;
            if (Storage::exists($video_path)) {
                return response()->download(storage_path() . '/app/' . $video_path);
            }
    
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required'
        ]);
        $link = Link::find($id);
        $link->name = request('name');
        $link->save();
        return redirect()->action('DownloadController@index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = Link::find($id);
        $symbolicLink = 'videos/' . $link->symbolic_link;
        if (Storage::exists($symbolicLink)) {
            Storage::delete($symbolicLink);
        }
        $link->delete();
        return redirect()->action('DownloadController@index');
    }
}
