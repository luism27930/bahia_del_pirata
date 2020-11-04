@extends('layouts.app')
@section('content')
<div class="container">
    @if ($message = Session::get('msg'))
        <div class='alert alert-success alert-dismissible my-3 container' id='mydiv'>
            <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <h5><center><strong>{{ $message }}</strong></center></h5>
        </div>
    @endif
        <div class="form-row my-2">
            <div class="form-group col-md-12">
                <div class="btn-toolbar justify-content-between" role="toolbar"
                    aria-label="Toolbar with button groups">
                    <div class="btn-group" role="group" aria-label="First group">
                    <a href="{{route('home')}}" class="btn btn-primary btn-lg my-2"  role="button"
                        aria-pressed="true"><i class="fa fa-home"></i> Volver</a>
                    </div>
                    <div class="text-center"><p class="h3"  style="color: #ffffff;">Mis videos</p></div>
                </div>
            </div>
        </div>
        <div class="row">
            @if (!empty($links))
                
                @each('downloads.card', $links, 'link')
            @endif
        </div>
    </div>
    @endsection