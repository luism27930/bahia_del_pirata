@extends('layouts.app')
@section('content')
<div class="container">
  <div class="text-center my-4"><p class="h1">Mi Contenido</p></div>
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 nocolor">
      <div class="card h-100 text-center ">
        <a href="{{ route('link.index') }}"><i class="fas fa-id-card fa-10x"></i></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="{{ route('link.index') }}">Listas de descarga</a>
          </h4>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
      <div class="card h-100 text-center">
        <a href="{{ route('download.index') }}"><i class="fas fa-book-reader fa-10x"></i></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="{{ route('download.index') }}">Videos listos para descargar</a>
          </h4>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
