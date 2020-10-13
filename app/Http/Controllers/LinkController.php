<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
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
        $links = Link::where('user_id',auth()->user()->id)->get();
        
        return view('videos.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        request()->validate([
            'name' => 'required',
            'link' => 'required',
            'format' => 'required',
        
        ]);

        $link = new Link();
        $link->user_id = Auth()->user()->id;
        $link->name = request('name');
        $link->link = request('link');
        $link->format = request('format');
        $link->proccesed = false;
        $link->save();
        return redirect()->action('LinkController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show($id){
    

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update($id){

        request()->validate([
            'name' => 'required',
            'link' => 'required',
            'format' => 'required',
        ]);
 
        $link = Link::find($id);
   
        $link->name = request('name');
        $link->link = request('link');
        $link->format = request('format');
        $link->save();
        return redirect()->action('LinkController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = Link::find($id);
        $link->delete();
        return redirect()->action('LinkController@index');
    }
}
