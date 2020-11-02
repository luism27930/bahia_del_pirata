<?php
$formats = ['mov', 'mpeg', 'avi', 'wmv', 'flv', '3gpp', 'webm', 'mp4', 'm4v'];
?>
<div class="modal fade" id="del{{$link->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header" style="background: #DC3545">
				<i class='fas fa-trash-alt' style='font-size:36px'></i>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body ">
				<div class="container-fluid">
					<h5><center>Está seguro de que desea eliminar la cola?</center></h5>
				</div>
			</div>
			<div class="modal-footer ">
				<form action="{{ route('link.destroy',$link->id) }}" method="POST">
					@csrf
					@method('DELETE')

					<button type="button" class="btn btn-secondary" data-dismiss="modal">
					<span class="glyphicon glyphicon-remove"></span>
						Cancelar
					</button>
					<button type="submit" class="btn btn-danger">Eliminar</button>

				</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /.modal -->
	<!-- Edit -->
	<div id="edit{{$link->id}}" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="linkModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background: #28A745">
					<h5 class="modal-title" id="linkModalLabel">Edit link  <i class="fas fa-edit"></i></h5>
					<button type="button" class="close"  data-dismiss="modal" aria-hidden="true" >&times;</button>
				</div>
				<form method="POST" action="{{ route('link.update',$link->id) }}">
					@csrf
					@method('PUT')
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
									<input type="text" name="name" class="form-control"
									value="{{$link->name}}" required>
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-12">
								<label >Link</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="material-icons">&#xe815;</i>
										</span>
									</div>
									<input type="text" name="link" class="form-control"
									value="{{$link->link}}" required>
								</div>
							</div>
						</div>
					
						

						<div class="form-row">
							<div class="form-group col-md-12">
								<div class="form-group">
									<select class="form-control" name="format" required>
										<option value="">Formato</option>
										@foreach ($formats as $format)
											@if($format == $link->format)
												<option  value='{{ $format }}' selected='selected'> {{ $format }}</option>
											@else 
											@php
												echo "<option value='".$format."'>$format</option>";
											@endphp
											@endif
										@endforeach
									</select>
								</div>
							</div>
						</div>

	

					</div>
					<div class="modal-footer" >
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Cancelar</button>
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span> Actualizar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit -->