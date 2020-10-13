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
                        aria-pressed="true"><i class="fa fa-home"></i> Home</a>
                    </div>
                    <div class="text-center"><p class="h3">Links</p></div>
                    <div class="btn-group">
                        <button style="background: orange; color: black" type="button"
                        class="btn btn-primary btn-lg my-2" id="new">
                        <i class="fas fa-hand-holding"></i> New
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            @if (!empty($links))
                {{-- Es como decir require --}}
                @each('videos.card', $links, 'link')
    
            @endif
        </div>
        
        <div id="Modal" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="articleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: orange">
                        <h5 class="modal-title" id="articleModalLabel">Agregar<i class='fas fa-pencil-alt' ></i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <form action="{{route('link.store')}}" method="post">
                    @csrf
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">

                                    <label >Nombre del video</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">&#xe815;</i>
                                            </span>
                                        </div>
                                        <input id="inputFocus" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name">
                                       @error('name')
                                           <div class="invalid-feedback">
                                               <strong> Name is required! </strong>
                                           </div>
                                       @enderror
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">

                                    <label >Link del video</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">&#xe815;</i>
                                            </span>
                                        </div>
                                        <input id="inputFocus" type="text" class="form-control @error('link') is-invalid @enderror"
                                        name="link" value="{{ old('link') }}" required autocomplete="link">
                                       @error('link')
                                           <div class="invalid-feedback">
                                               <strong> Link is required! </strong>
                                           </div>
                                       @enderror
                                    
                                    </div>
                                </div>
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <select class="form-control" name="format" required>
                                            <option value="">Format</option>
                                            @php
                                            $formats=['MOV', 'MPEG', 'AVI', 'WMV', 'FLV', '3GPP', 'WebM', 'MP4', 'M4V'];
                                              foreach ($formats as $format) {
                                                echo "<option value='".$format."'>$format</option>";
                                            }
                                        @endphp
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    
                            <input type="submit" class="btn btn-primary" value="Register">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection