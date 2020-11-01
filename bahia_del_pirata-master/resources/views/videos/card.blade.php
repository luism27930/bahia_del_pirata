<style>
	.extremeColor {
		background-color: #007BFF;
	}
	.mainColor {
		background-color: #f2f6f0;
	}
</style>
<div class="col-lg-4 col-sm-6 mb-4">
	<div class="card h-100 ">
		<div class="card-header extremeColor">
		</div>
		<div class="card-body mainColor ">
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Nombre</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i style='font-size:24px' class='fa fa-video'>&#xf03d;</i>
							</span>
						</div>
						<input type="text" name="name" class="form-control"
						value="{{$link->name}} " disabled>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Link</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i style='font-size:24px' class='material-icons'>&#xe80b;</i>
							</span>
						</div>
						<input type="text" name="link" class="form-control"
						value="{{$link->link}} " disabled>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Estado</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i style='font-size:24px' class='far fa-clock'>&#xf017;</i>
							</span>
						</div>
						<input type="text" name="name" class="form-control"
						@switch($link->success)
							@case('null')
							value="En espera" disabled
								@break
							@case('inProcess')
							value="Procesando" disabled
								@break
							@case('false')
							value="Error en la descarga" disabled
								@break
							@default		
						@endswitch
						>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					
					<label >Formato</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i style='font-size:24px' class='far'>&#xf1c8;</i>
							</span>
						</div>
						<input type="text" name="format" class="form-control"
						value="{{$link->format}} " disabled>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer extremeColor text-center">
			@if($link->success == 'false')
			||<a href="#del{{$link->id}}" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>
			@endif
			@include('videos.modals')
		</div>
	</div>
</div>