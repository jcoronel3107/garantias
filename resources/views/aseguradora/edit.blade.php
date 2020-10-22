	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Editar Información de Aseguradora</h1>

		@can('edit aseguradora')
			<form method="post" action="/aseguradora/{{$aseguradora->id}}">
				@csrf @method('PATCH')
				<div class="form-row">
					{{csrf_field()}}
					<div class="form-group input-group  col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Razon Social</span>
						</div>
						<input type="text" maxlength="100" required="" name="Razon Social" placeholder="Digite la Razón Social" value="{{$aseguradora->Razon_Social}}" class="form-control">
					</div>
					<div class="form-group input-group  col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Ruc</span>
						</div>
						<input type="text" required="" name="Ruc" placeholder="Digite el Ruc" maxlength="13" value="{{$aseguradora->Ruc}}" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Actualizar</button>

					<a class="btn btn btn-primary" role="button"
						href="{{ route('aseguradora.index')}}">Cancelar
					</a>
				</div>
			</form>
			<form method="post" action="/aseguradora/{{$aseguradora->id}}">
				{{csrf_field()}}
				<input type="hidden" name="_method" value="DELETE">

				<button type="button" class="btn btn-primary btn-danger" data-toggle="modal" data-target="#exampleModal">Eliminar Registro</button>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
				        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <p>El registro seleccionado será eliminado. Esta Seguro?...</p>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button  type="submit" name="Eliminar" value="Eliminar" class="btn btn-primary">Ok</button>
				      </div>
				    </div>
				  </div>
				</div>
			</form>
			@if(count($errors)>0) @foreach($errors->all() as $error)
			<div class="alert alert-danger" role="alert">
				{{$error}}
			</div>
			@endforeach @endif
		@else
  			<p>Lo sentimos, No Tienes Permisos de Edición.</p>
		@endcan
	@endsection

	@section( "piepagina" )


	@endsection