@extends('layouts.app')
@section('content')
<div class="container">
    @isset($success)
        @switch($success)
            @case(true)
            <div class='alert alert-success alert-dismissible my-3 container' id='mydiv'>
                <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <h5>
                    <center><strong>{{ $message }}</strong></center>
                </h5>
            </div>
            @break
            @case(false)
            <div class='alert alert-danger alert-dismissible my-3 container' id='mydiv'>
                <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <h5>
                    <center><strong>{{ $message}}</strong></center>
                </h5>
            </div>
            @break
            @default
        @endswitch
    @endisset


    <script>
        // //for success
        // swal("Done!", 'Video agregado exitosamente!', "success");
        // //for error
        // swal("Error!", 'results.message', "error");
    </script>
    <div class="form-row my-2">
        <div class="form-group col-md-12">
            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="First group">
                    <a href="{{route('home')}}" class="btn btn-primary btn-lg my-2" role="button" aria-pressed="true"><i class="fa fa-home"></i> Volver</a>
                </div>
                <div class="text-center">
                    <p class="h3" style="color: #ffffff;">Gestión de descargas</p>
                </div>
                <div class="btn-group">
                    <button style="background: orange; color: black" type="button" class="btn btn-primary btn-lg my-2" id="new">
                        <i class="fas fa-plus-circle">&#xf055;</i> Agregar
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
    <div id="Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="articleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: orange">
                    <h5 class="modal-title" id="articleModalLabel">Agrega un video a la lista de descargas<i class='fas fa-pencil-alt'></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formAdd" action="{{route('link.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Nombre del video</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i style='font-size:24px' class='fa fa-video'>&#xf03d;</i>
                                        </span>
                                    </div>
                                    <input id="inputFocus" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        <strong> El nombre es requerido! </strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Link del video</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i style='font-size:24px' class='material-icons'>&#xe80b;</i>
                                        </span>
                                    </div>
                                    <input id="inputFocus" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link') }}" required autocomplete="link">
                                    @error('link')
                                    <div class="invalid-feedback">
                                        <strong> El link o url es requerido! </strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <select class="form-control" name="format" required>
                                        <option value="">Formato</option>
                                        @php
                                        $formats = ['mov', 'mpeg', 'avi', 'wmv', 'flv', 'mkv', 'webm', 'mp4', 'm4v'];
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <input id="formAddBtn" type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection