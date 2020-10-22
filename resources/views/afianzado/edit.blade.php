@extends( "layouts.plantilla" )

@section( "cabeza" )


@endsection

@section( "cuerpo" )
	<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Editar Información de Clave_14</h1>

	@can('edit afianzados')
		<form method="post" action="/afianzado/{{$afianzado->id}}">
			@csrf @method('PATCH')
			<div class="form-row">
					<div class="form-group input-group  col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">Nombres Completos</span>
						</div>
						<input type="text" value="{{old('afianzado',$afianzado->afianzado)}}" required="" name="afianzado" placeholder="Digite Nombres Completos / Razòn Social del Afianzado" class="form-control"> {{csrf_field()}}
					</div>
			</div>
			<div class="form-row">
				<div class="form-group input-group col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">Ruc / C.I.</span>
						</div>
						<input type="text" value="{{old('ruc',$afianzado->ruc)}}" required="" name="ruc" class="form-control" id="kmllegada" placeholder="Digite RUC/CI de Afianzado">
					</div>
			</div>
			<div class="form-row">
				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
							<span class="input-group-text">Direccion</span>
					</div>
					<input type="text" value="{{old('direccion',$afianzado->direccion)}}" required="" name="direccion" class="form-control" placeholder="Digite Dirección del Afianzado">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group  input-group col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">E.Mail</span>
						</div>
						<input type="text" value="{{old('mail',$afianzado->mail)}}" required="" name="mail" class="form-control" id="mail" placeholder="Digite Correo Electronico del Afianzado">
					</div>
			</div>

			<div class="form-group">
				<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Actualizar</button>
				<a class="btn btn btn-primary" role="button"
						href="{{ route('afianzado.index')}}">Cancelar
				</a>
			</div>
		</form>
		<form method="post" action="/afianzado/{{$afianzado->id}}">
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
		@if(count($errors)>0)
			@foreach($errors->all() as $error)
				<div class="alert alert-danger" role="alert">
				{{$error}}
				</div>
			@endforeach
		@endif
	@else
  		<p>Lo sentimos, No Tienes Permisos de Edicion.</p>
	@endcan
@endsection

@section( "piepagina" )


@endsection