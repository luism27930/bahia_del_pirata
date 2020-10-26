<?php

namespace App\Http\Controllers;

use Auth;
use App\Link;
use Illuminate\Http\Request;
use App\Jobs\LinkJob;
use GuzzleHttp\Psr7\Message;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

use Illuminate\Support\Facades\Storage; #videos in local disk

class LinkController extends Controller
{   
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendLink()
    {
    }
    public function all()
    {
       return Link::where('user_id', auth()->user()->id)->where('success', '!=', 'true')->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = $this->all();
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
        $success = true;
        $message = "Video agregado con éxito";
        request()->validate([
            'name' => 'required',
            'link' => 'required',
            'format' => 'required',
        ]);
        $link = new Link();
        if (Link::where('user_id', Auth()->user()->id)->where('format', $request->format)->where('link', $request->link)->exists()){
            $success = false;
            $message = "El video que intenta descargar ya fue descargado!";
            $links = $this->all();
            return view('videos.index', compact('links','success','message'));
        }




        $link->user_id = Auth()->user()->id;
        $link->name = request('name');
        $link->link = request('link');
        $link->format = request('format');
        $link->success = 'null';

        $link->save();

        try {
            $connection = new AMQPStreamConnection('shrimp-01.rmq.cloudamqp.com', 5672, 'gafnmalf', 'dfidH6NSrF-w5gZkZ25zXNsVsViFLI7P');
            $channel = $connection->channel();
            $channel->queue_declare('default', true, false, false, false);
            $msg = new AMQPMessage($link);
            $channel->basic_publish($msg, '', 'default');
            $channel->close();
            $connection->close();
        } catch (\Throwable $th) {
        }



        $directory = 'videos/';
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }
        $success = true;
        $message = "Video agregado con éxito";
        $links = $this->all();
        return view('videos.index', compact('links','success','message'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $existRegister=Link::where('user_id', Auth()->user()->id)->where('format', request('format'))->where('link', request('link'))->get(); 
        if ($existRegister) {
            return redirect()->action('LinkController@index');
        }
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
